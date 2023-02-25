<?php

namespace CleaniqueCoders\LaravelHelper\Tests;

use CleaniqueCoders\LaravelHelper\Notifications\Notification as N;
use CleaniqueCoders\LaravelHelper\Tests\Stubs\User;
use Illuminate\Support\Facades\Notification;

class NotifyTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->loadLaravelMigrations(['--database' => 'testbench']);
        $this->artisan('migrate', ['--database' => 'testbench']);
    }

    /** @test */
    public function it_has_notify_helper()
    {
        $this->assertTrue(function_exists('notify'));
    }

    /** @test */
    public function it_has_notify_service()
    {
        $this->assertTrue(class_exists(\CleaniqueCoders\LaravelHelper\Services\NotificationService::class));
    }

    /** @test */
    public function it_has_notify_no_exceptions()
    {
        $this->assertTrue(class_exists(\CleaniqueCoders\LaravelHelper\Exceptions\NoUserSpecifiedException::class));
    }

    /** @test */
    public function it_has_notify_model_config()
    {
        $this->assertNotNull(config('helper.models.user'));
        // since we swap the config above
        $this->assertNotEquals(config('helper.models.user'), \App\User::class);
    }

    /** @test */
    public function it_has_notification_default_view()
    {
        $this->assertFileExists(__DIR__.'/../views/mail/notification.blade.php');
    }

    /** @test */
    public function it_can_send_notification_via_notify_helper()
    {
        Notification::fake();

        $user = User::create([
            'name' => 'Laravel Helper',
            'email' => 'laravel-helper@cleaniquecoders.com',
            'password' => bcrypt('password'),
        ]);

        $user2 = User::create([
            'name' => 'Laravel Helper',
            'email' => 'laravel-helper-two@cleaniquecoders.com',
            'password' => bcrypt('password'),
        ]);

        notify(1)->subject('Laravel Helper')->message('Send notification with notify helper.')->send();

        Notification::assertSentTo(
            $user,
            N::class,
            function ($notification, $channels) {
                return 'Laravel Helper' == $notification->subject && 'Send notification with notify helper.' == $notification->content;
            }
        );

        // Assert a notification was sent to the given users...
        Notification::assertSentTo(
            [$user],
            N::class
        );

        // Assert a notification was not sent...
        Notification::assertNotSentTo(
            [$user2],
            N::class
        );
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('helper.models.user', \CleaniqueCoders\LaravelHelper\Tests\Stubs\User::class);
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}
