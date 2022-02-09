<?php

namespace App\Console\Commands;

use App\Name;
use Illuminate\Console\Command;

class SeparateEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lw:separate.emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $file_path = storage_path("app/000websplit0011.txt");
// Check if file already exists
$file_limit = 5000;
$count = 1;
    if (file_exists($file_path)) {
        $fp = fopen($file_path, "r");
        $fff = storage_path("app/emails.csv");
        $fpf = fopen($fff, 'w');
        while (($line = stream_get_line($fp, 1024 * 1024, "\n")) !== false) {        
            $row = explode(":",$line);
            //check if first contains ***
            if(strpos($row[0],"***") === false)
            {
                $row = explode("***",$line);
            }
            //echo $email."<br>";
            $email = $row[1] ?? '';
            // dd($row);
            // //$this->info($row);
            // return 0;
            if($count %$file_limit == 0)
            {
                fclose($fpf);
                $fff = storage_path("app/emails--".$count.".csv");
                $fpf = fopen($fff,"w");
                $this->info($count);
            }
            if(strpos($email,"@") !== false)
            {
                $phone_number = "256774".rand(111000,999999);
                $first_name = Name::inRandomOrder()->first()->name;
                $last_name = Name::inRandomOrder()->first()->name;
                //dd($last_name);
                $srow = [$first_name,$last_name,$phone_number,$email,'Kampala','Uganda'];
                fputcsv($fpf, $srow);
                $count++;
            }
            
        }
        fclose($fp);
        fclose($fpf);
    }
    else{
        $this->info("file doesnt exist at $file_path");
    }
    }
}
