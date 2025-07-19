<?php

namespace App\Domains\Company\Listeners;

use App\Domains\Company\Events\Company\CompanyCreated;
use App\Domains\Company\Events\Company\JobDeleted;
use App\Domains\Company\Events\Company\JobDestroyed;
use App\Domains\Company\Events\Company\JobLoggedIn;
use App\Domains\Company\Events\Company\JobRestored;
use App\Domains\Company\Events\Company\JobStatusChanged;
use App\Domains\Company\Events\Company\JobUpdated;

/**
 * Class CompanyEventListener.
 */
class CompanyEventListener
{
    /**
     * @param $event
     */
    public function onLoggedIn($event)
    {
        // Update the logging in users time & IP
        $event->company->update([
            'last_login_at' => now(),
            'last_login_ip' => request()->getClientIp(),
        ]);
    }

    /**
     * @param $event
     */
    public function onPasswordReset($event)
    {
        $event->company->update([
            'password_changed_at' => now(),
        ]);
    }

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        activity('company')
            ->performedOn($event->company)
            ->withProperties([
                'company' => [
                    'name' => $event->company->title,
                    'address' => $event->company->address,
                    'email' => $event->company->email,
                ],
            ])
            ->log(':causer.name created company :subject.name with roles: :properties.roles and permissions: :properties.permissions');
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        activity('company')
            ->performedOn($event->company)
            ->withProperties([
                'company' => [
                    'name' => $event->company->title,
                    'address' => $event->company->address,
                    'email' => $event->company->email,
                ],])
            ->log(':causer.name updated company :subject.name with roles: :properties.roles and permissions: :properties.permissions');
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        activity('company')
            ->performedOn($event->company)
            ->log(':causer.name deleted company :subject.name');
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        activity('company')
            ->performedOn($event->company)
            ->log(':causer.name restored company :subject.name');
    }

    /**
     * @param $event
     */
    public function onDestroyed($event)
    {
        activity('company')
            ->performedOn($event->company)
            ->log(':causer.name permanently deleted company :subject.name');
    }

    /**
     * @param $event
     */
    public function onStatusChanged($event)
    {
        activity('company')
            ->performedOn($event->company)
            ->log(':causer.name '.($event->status === 0 ? 'deactivated' : 'reactivated').' company :subject.name');
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
            'App\Domains\Auth\Listeners\CompanyEventListener@onLoggedIn'
        );

        $events->listen(
            CompanyCreated::class,
            'App\Domains\Auth\Listeners\UserEventListener@onCreated'
        );

        $events->listen(
            JobUpdated::class,
            'App\Domains\Auth\Listeners\CompanyEventListener@onUpdated'
        );

        $events->listen(
            JobDeleted::class,
            'App\Domains\Auth\Listeners\CompanyEventListener@onDeleted'
        );

        $events->listen(
            JobRestored::class,
            'App\Domains\Auth\Listeners\CompanyEventListener@onRestored'
        );

        $events->listen(
            JobDestroyed::class,
            'App\Domains\Auth\Listeners\CompanyEventListener@onDestroyed'
        );

        $events->listen(
            JobStatusChanged::class,
            'App\Domains\Auth\Listeners\CompanyEventListener@onStatusChanged'
        );
    }
}
