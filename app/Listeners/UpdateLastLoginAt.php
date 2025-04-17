namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;

class UpdateLastLoginAt
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // Update the last_login_at column when the user logs in
        DB::table('users')
            ->where('id', $event->user->id)
            ->update(['last_login_at' => now()]); // Store the current timestamp
    }
}
