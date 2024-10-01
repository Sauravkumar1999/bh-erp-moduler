<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureForUpdateDocumentCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $sql_drop_proc = "DROP PROCEDURE IF EXISTS `update_doc_code`;";

        DB::unprepared($sql_drop_proc);

        $sql_Create_proc = "CREATE PROCEDURE `update_doc_code`(
                  IN table_name VARCHAR (25),
                  IN column_name VARCHAR (25),
                  IN prefix VARCHAR (5),
                  IN digits INT,
                  OUT last_code INT(10)
                )
                BEGIN
                  DECLARE start_in INT DEFAULT 0;
                  DECLARE strLen INT DEFAULT 0;
                  DECLARE SubStrLen INT DEFAULT 0;
                  DECLARE strIDs TEXT DEFAULT NULL;
                  SET @SQL_SELECT = CONCAT(
                    'SELECT ',
                    'GROUP_CONCAT(id ORDER BY id ASC)',
                    ' INTO @IDS FROM ',
                    table_name
                  );
                  SET @SQL_UPDATE = CONCAT(
                    'UPDATE IGNORE ',
                    table_name,
                    ' SET ',
                    column_name,
                    ' = ? WHERE id = ?'
                  );
                  PREPARE stmt_sel FROM @SQL_SELECT;
                  EXECUTE stmt_sel;
                  DEALLOCATE PREPARE stmt_sel;
                  SET strIDs = @IDS;
                  -- START TRANSACTION;
                  WHILE
                    LENGTH(strIDs) > 0 DO
                    SET start_in = start_in + 1;
                    SET @p1 = SUBSTRING_INDEX(strIDs, ',', 1);
                    SET @p2 = CONCAT(prefix,LPAD(start_in, digits,'0'));
                    PREPARE stmt_upd FROM @SQL_UPDATE;
                    EXECUTE stmt_upd USING @p2,@p1;
                    DEALLOCATE PREPARE stmt_upd;

                    IF LOCATE(',', strIDs) > 0
                    THEN SET strIDs = SUBSTR(strIDs, LOCATE(',', strIDs) + 1);
                    ELSE SET strIDs = '';
                    END IF;

                    SET last_code = start_in;
                  END WHILE;
                  -- COMMIT;

                  SELECT last_code + 1 AS code_next ;
                END;";

        DB::unprepared($sql_Create_proc);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS `update_doc_code`');
    }
}
