<?php

namespace App\Console\Commands;

use dataradar;
use App\data_radar;
use Carbon\Carbon;
use Illuminate\Console\Command;
// use Illuminate\Support\Facades\dataradar;

class HapusData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hapus:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'menghapus data tabel yang sudah lebih dari 5 hari';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    
        // $posts = dataradar::table('data_radar')
        // ->whereDate('created_at', '<', date('Y-m-d')-3)
        // ->delete();
        
        $limit = Carbon::now()->subDay(5);
        $buang = \dataradar::table('data_radar')->where('created_at', '<', $limit)
        ->delete();

        // dataradar::table('data_radar')->where('created_at', '<', Carbon::now()->subDays(5))->delete();
        dd("berhasil dihapus, gudjob sayang");
        // ->count()
        // ->groupBy('created_at')
        // ->get()
       
    //   // update statistics table
    //   foreach($posts as $post)
    //   {
    //     DB::table('users_statistics')
    //     ->where('user_id', $post->user_id)
    //     ->update(['total_posts' => $post->total_posts]);

        // dataradar::table('data_radar')->where('created_at', '<', Carbon::now()->subDays(5))->delete();
    //     echo "<script> console.log('tes')</script>";
    //     dd("cronjob sukses, gudjob grace");
    }
}
