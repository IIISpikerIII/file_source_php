<?
class FileHelper
{
	const folders= 3;

    /**
     * Set unique filename and directory
     * @param $path
     * @param string $extension
     * @return string
     */
    public static function getRandomFileName($path, $extension='')
    {
        $extension = $extension ? '.' . $extension : '';
        $path = $path ? $path . '/' : '';

        if(!file_exists($path))
            mkdir($path);

        do {
            $name = md5(microtime() . rand(0, 9999));
            $file = $path . $name . $extension;
        } while (file_exists($file));
 
        return $name;
    }

    /**
     * get files path
     * @return string
     */
    public static function ab_filespath(){
        return FILES_PATH.'/';
    }

    /**
     * loading file to server
     * @param $file
     * @return bool|string
     */
    public static function load_file($file)
    {
        $answer = false;

        $folder = rand(1, self::folders);

        $filename = FileHelper::getRandomFileName(FileHelper::ab_filespath().$folder.'/', '');
        $filename = $folder.'/'.$filename;

        if(copy( $file, FileHelper::ab_filespath().$filename))
            $answer = $filename;

        return $answer;
    }

    /**
     * remove file from server
     * @param $file
     * @return bool
     */
    public static function remove_file($file)
    {
        $path = FileHelper::ab_filespath().$file;

        if (!file_exists($path))
            unlink($path);
        else
            return false;

        return true;
    }

    /**
     * upload file to computer
     * @param $file
     */
    public static function upload_file($file)
    {
       $path = FileHelper::ab_filespath().$file;

        if (!file_exists($path))
           return false;

        if (ob_get_level()) {
            ob_end_clean();
        }

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file).'"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));

        readfile($path);
        exit;
    }
}