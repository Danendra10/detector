<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSummaryDataTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER insert_meteran_value
        AFTER INSERT ON meterans
        FOR EACH ROW
        BEGIN
            IF EXISTS(SELECT * FROM summary_data WHERE type = NEW.type AND units_id = NEW.units_id AND year = NEW.year) THEN
                UPDATE summary_data
                SET jan = IF(month = 1, NEW.meteran_value, jan),
                    feb = IF(month = 2, NEW.meteran_value, feb),
                    mar = IF(month = 3, NEW.meteran_value, mar),
                    apr = IF(month = 4, NEW.meteran_value, apr),
                    may = IF(month = 5, NEW.meteran_value, may),
                    jun = IF(month = 6, NEW.meteran_value, jun),
                    jul = IF(month = 7, NEW.meteran_value, jul),
                    aug = IF(month = 8, NEW.meteran_value, aug),
                    sep = IF(month = 9, NEW.meteran_value, sep),
                    oct = IF(month = 10, NEW.meteran_value, oct),
                    nov = IF(month = 11, NEW.meteran_value, nov),
                    `dec` = IF(month = 12, NEW.meteran_value, `dec`)
                WHERE type = NEW.type AND units_id = NEW.units_id AND year = NEW.year;
            ELSE
                INSERT INTO summary_data (type, units_id, year, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, `dec`)
                VALUES (NEW.type, NEW.units_id, NEW.year,
                        IF(NEW.month = 1, NEW.meteran_value, 0),
                        IF(NEW.month = 2, NEW.meteran_value, 0),
                        IF(NEW.month = 3, NEW.meteran_value, 0),
                        IF(NEW.month = 4, NEW.meteran_value, 0),
                        IF(NEW.month = 5, NEW.meteran_value, 0),
                        IF(NEW.month = 6, NEW.meteran_value, 0),
                        IF(NEW.month = 7, NEW.meteran_value, 0),
                        IF(NEW.month = 8, NEW.meteran_value, 0),
                        IF(NEW.month = 9, NEW.meteran_value, 0),
                        IF(NEW.month = 10, NEW.meteran_value, 0),
                        IF(NEW.month = 11, NEW.meteran_value, 0),
                        IF(NEW.month = 12, NEW.meteran_value, 0));
            END IF;
        END;
    
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('summary_data_trigger');
    }
}
