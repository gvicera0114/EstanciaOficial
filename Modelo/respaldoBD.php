<?php

    class bd{

                
        

        function downloadBackup() {
            $dbHost = 'localhost';
            $dbUsername = 'root';
            $dbPassword = '1234';
            $dbName = 'clinica';
            $mysqlBinDir = 'C:\\Program Files\\MySQL\\MySQL Server 8.0\\bin'; 


            $backupFile = $dbName . '_backup_' . date('Y-m-d_H-i-s') . '.sql';
            $command = "\"$mysqlBinDir\\mysqldump\" --host=$dbHost --user=$dbUsername --password=$dbPassword $dbName > $backupFile";

            system($command);
            if (file_exists($backupFile)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . basename($backupFile));
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($backupFile));
                readfile($backupFile);

                exit;
            } else {
                header('Location: respaldoBD.php');
                exit();
            }
            
            
        }


        function uploadBackup($filePath) {
            $dbHost = 'localhost';
            $dbUsername = 'root';
            $dbPassword = '1234';
            $dbName = 'clinica';
            $mysqlBinDir = 'C:\\Program Files\\MySQL\\MySQL Server 8.0\\bin';
            $command = "\"$mysqlBinDir\\mysql\" --host=$dbHost --user=$dbUsername --password=$dbPassword $dbName < $filePath 2>&1";

            exec($command, $output, $return_var);

            if ($return_var !== 0) {
            
                echo "Error al cargar el respaldo: " . implode("\n", $output);
            
                error_log("Error al cargar el respaldo: " . implode("\n", $output));
            } else {
            }
        }

        




    }

?>