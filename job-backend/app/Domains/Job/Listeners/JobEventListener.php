<?php

namespace App\Domains\Job\Listeners;

use App\Domains\Job\Events\Job\JobCreated;
use App\Domains\Job\Events\Job\JobDeleted;
use App\Domains\Job\Events\Job\JobDestroyed;
use App\Domains\Job\Events\Job\JobLoggedIn;
use App\Domains\Job\Events\Job\JobRestored;
use App\Domains\Job\Events\Job\JobStatusChanged;
use App\Domains\Job\Events\Job\JobUpdated;

/**
 * Class JobEventListener.
 */
class JobEventListener
{
    /**
     * @param $event
     */
    public function onLoggedIn($event)
    {
        // Update the logging in users time & IP
        $event->job->update([
            'last_login_at' => now(),
            'last_login_ip' => request()->getClientIp(),
        ]);
    }

    /**
     * @param $event
     */
    public function onPasswordReset($event)
    {
        $event->job->update([
            'password_changed_at' => now(),
        ]);
    }

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        activity('job')
            ->performedOn($event->job)
            ->withProperties([
                'job' => [
                    'name' => $event->job->title,
                    'address' => $event->job->address,
                ],
            ])
            ->log(':causer.name created job :subject.name with roles: :properties.roles and permissions: :properties.permissions');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        activity('job')
            ->performedOn($event->job)
            ->withProperties([
                'job' => [
                    'name' => $event->job->title,
                    'address' => $event->job->address,
                ],])
            ->log(':causer.name updated job :subject.name with roles: :properties.roles and permissions: :properties.permissions');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        activity('job')
            ->performedOn($event->job)
            ->log(':causer.name deleted job :subject.name');
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        activity('job')
            ->performedOn($event->job)
            ->log(':causer.name restored job :subject.name');
    }

    /**
     * @param $event
     */
    public function onDestroyed($event)
    {
        activity('job')
            ->performedOn($event->job)
            ->log(':causer.name permanently deleted job :subject.name');
    }

    /**
     * @param $event
     */
    public function onStatusChanged($event)
    {
        activity('job')
            ->performedOn($event->job)
            ->log(':causer.name '.($event->status === 0 ? 'deactivated' : 'reactivated').' job :subject.name');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            JobLoggedIn::class,
            'App\Domains\Auth\Listeners\jobEventListener@onLoggedIn'
        );

        $events->listen(
            JobCreated::class,
            'App\Domains\Auth\Listeners\JobEventListener@onCreated'
        );

        $events->listen(
            JobUpdated::class,
            'App\Domains\Auth\Listeners\JobEventListener@onUpdated'
        );

        $events->listen(
            JobDeleted::class,
            'App\Domains\Auth\Listeners\JobEventListener@onDeleted'
        );

        $events->listen(
            JobRestored::class,
            'App\Domains\Auth\Listeners\JobEventListener@onRestored'
        );

        $events->listen(
            JobDestroyed::class,
            'App\Domains\Auth\Listeners\JobEventListener@onDestroyed'
        );

        $events->listen(
            JobStatusChanged::class,
            'App\Domains\Auth\Listeners\JobEventListener@onStatusChanged'
        );
    }
}
