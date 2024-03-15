<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DataManipulation
{
    private $query;
    public function selectdata($tablename, array $tablewherecondition = [])
    {
        $this->query = DB::table($tablename)
            ->where($tablewherecondition)
            ->get();

           return $this->query;
        }

    public function insertdata($tablename, array $tabledata)
    {

          $this->query = DB::table($tablename)->insert($tabledata);

           return $this->query;
        }

    public function updatedata($tablename, array $tablewherecondition, array $tableupdatedata)
    {
        $this->query = DB::table($tablename)
            ->where($tablewherecondition)
            ->update($tableupdatedata);
           return $this->query;
        }

    public function deletedata($tablename, array $tablewherecondition)
    {
        $this->query = DB::table($tablename)
            ->where($tablewherecondition)
            ->delete();

           return $this->query;

    }
}
