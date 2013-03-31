<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ActiveRecordResizeImage
 *
 * @author devel
 */
class CUploadedFileResize //extends CUploadedFile
{

    public $maxExecuttionTime = 60;
    public $stampPath;
    public $baseDir;
    public $width;
    public $height;
    public $quality = 100;
    private $_uploadObj;
    
    
    public function __construct(CUploadedFile $CUploadedFile)
    {
        $this->_uploadObj = $CUploadedFile;
    }
   
    public function saveAs()
    {
        $this->_uploadObj->saveAs();
    }
    
    public function getSize()
    {
        return $this->_uploadObj->getSize();
    }
    
    public function getTempName()
    {
        return $this->_uploadObj->getTempName();
    }

    public function saveResize($to)
    {
        ini_set('max_execution_time', '120');
        $errorIndex = 0;
        // защита от Null-байт уязвимости PHP
        if (empty($this->baseDir))
            $this->baseDir = $_SERVER['DOCUMENT_ROOT'];



        if (empty($to))
            throw new Exception('Empty save to', ++$errorIndex);


        if ($this->getSize() <= 0)
            throw new Exception('Empty size', ++$errorIndex);

        if (!strpos($to, $this->baseDir)) {
            $to = $this->baseDir . '/' . $to;
            $to = preg_replace('/\/+/', '/', $to);
        }

        $from = $this->getTempName();


        $from = preg_replace('/\0/uis', '', $from);
        $to = preg_replace('/\0/uis', '', $to);

        $stamp = null;

        if (!empty($this->stampPath)) {
            if (is_file($this->stampPath)) {
                $stamp = imagecreatefrompng($this->stampPath);
            } elseif (is_file($this->baseDir . $this->stampPath)) {
                $stamp = imagecreatefrompng($this->baseDir . $this->stampPath);
            }
        }


        // информация об изображении
        $imageinfo = @getimagesize($from);
        // если получить информацию не удалось - ошибка
        if (!$imageinfo)
            throw new Exception('Error to get info about image', ++$errorIndex);


        if ($this->width == 0)
            $this->width = $imageinfo[0];
        if ($this->height == 0)
            $this->height = $imageinfo[1];

        // получаем параметры изображения
        $width = $imageinfo[0];  // ширина
        $height = $imageinfo[1]; // высота
        $format = $imageinfo[2]; // ID формата (число)
        $mime = $imageinfo['mime']; // mime-тип
        // определяем формат и создаём изображения
        switch ($format) {
            case 2: $img = imagecreatefromjpeg($from);
                break; // jpg
            case 3: $img = imagecreatefrompng($from);
                break; // png
            case 1: $img = imagecreatefromgif($from);
                break; // gif
            default: throw new Exception('Error format', ++$errorIndex);
                return false;
                break;
        }
        // если создать изображение не удалось - ошибка
        if (!$img)
            throw new Exception('Error create', ++$errorIndex);

        // меняем размеры изображения
        $newwidth = $width;
        $newheight = $height;
        // требуется квадратная картинка
        if ($this->width == $this->height) {
            // размеры картинки больше по X и по Y
            if ($width > $this->width && $height > $this->height) {
                // пропорции картинки одинаковы
                if ($width == $height) {
                    $newwidth = $this->width;
                    $newheight = $this->height;
                }
                // ширина больше
                elseif ($width > $height) {
                    $newwidth = $this->width;
                    $newheight = intval(((float) $newwidth / (float) $width) * $height);
                }
                // высота больше
                else {
                    $newheight = $this->height;
                    $newwidth = intval(((float) $newheight / (float) $height) * $width);
                }
            }
            // размеры картинки больше только по X
            elseif ($width > $this->width) {
                $newwidth = $this->width;
                $newheight = intval(((float) $newwidth / (float) $width) * $height);
            }
            // размеры картинки больше только по Y
            elseif ($height > $this->height) {
                $newheight = $this->height;
                $newwidth = intval(((float) $newheight / (float) $height) * $width);
            }
            // в остальных случаях ничего менять не надо
            else {
                $newwidth = $width;
                $newheight = $height;
            }
        }
        // требуется горизонтальная картинка
        elseif ($this->width > $this->height) {
            // размеры картинки больше по X и по Y
            if ($width > $this->width && $height > $this->height) {
                // ширина больше
                if ($width > $height) {
                    $newwidth = $this->width;
                    $newheight = intval(((float) $newwidth / (float) $width) * $height);

                    if ($newheight > $this->height) {
                        $newheight = $this->height;
                        $newwidth = intval(((float) $newheight / (float) $height) * $width);
                    }
                }
                // высота больше или равна ширине
                else {
                    $newheight = $this->height;
                    $newwidth = intval(((float) $newheight / (float) $height) * $width);
                }
            }
            // размеры картинки больше только по X
            elseif ($width > $this->width) {
                $newwidth = $this->width;
                $newheight = intval(((float) $newwidth / (float) $width) * $height);
            }
            // размеры картинки больше только по Y
            elseif ($height > $this->height) {
                $newheight = $this->height;
                $newwidth = intval(((float) $newheight / (float) $height) * $width);
            }
            // в остальных случаях ничего менять не надо
            else {
                //echo '1';
                $newwidth = $width;
                $newheight = $height;
            }
        }
        // требуется вертикальная картинка
        elseif ($this->width < $this->height) {
            // размеры картинки больше по X и по Y
            if ($width > $this->width && $height > $this->height) {
                // ширина больше или равна высоте
                if ($width >= $height) {
                    $newwidth = $this->width;
                    $newheight = intval(((float) $newwidth / (float) $width) * $height);
                }
                // высота больше
                else {
                    $newheight = $this->height;
                    $newwidth = intval(((float) $newheight / (float) $height) * $width);
                }
            }
            // размеры картинки больше только по X
            elseif ($width > $this->width) {
                $newwidth = $this->width;
                $newheight = intval(((float) $newwidth / (float) $width) * $height);
            }
            // размеры картинки больше только по Y
            elseif ($height > $this->height) {
                $newheight = $this->height;
                $newwidth = intval(((float) $newheight / (float) $height) * $width);
            }
            // в остальных случаях ничего менять не надо
            else {
                $newwidth = $width;
                $newheight = $height;
            }
        }


        // создаём новое изображение
        //$new = imagecreatetruecolor($newwidth, $newheight);
        $new = imagecreatetruecolor($this->width, $this->height);
        $black = imagecolorallocate($new, 0, 0, 0);
        $white = imagecolorallocate($new, 255, 255, 255);
        // копируем старое в новое с учётом новых размеров
        imagefilledrectangle($new, 0, 0, $this->width - 1, $this->height - 1, $white);
        //imagecolortransparent($new, $white);
        $center_w = round(($this->width - $newwidth) / 2);
        $center_w = ($center_w < 0) ? 0 : $center_w;
        $center_h = round(($this->height - $newheight) / 2);
        $center_h = ($center_h < 0) ? 0 : $center_h;
        imagecopyresampled($new, $img, $center_w, $center_h, 0, 0, $newwidth, $newheight, $width, $height);

        if ($stamp != null) {
            imagecopyresampled($new, $stamp, 0, 0, 0, 0, $this->width - 1, $this->height - 1, $this->width - 1, $this->height - 1);
            //imagecopymerge($new,$stamp, 0, 0, 0, 0, $width, $height, 20);
        }
        // создаём файл с новым изображением
        switch ($format) {
            case 2: // jpg
                if ($this->quality < 0)
                    $this->quality = 0;
                if ($this->quality > 100)
                    $this->quality = 100;
                imagejpeg($new, $to, $this->quality);
                break;
            case 3: // png
                $this->quality = intval($this->quality * 9 / 100);
                if ($this->quality < 0)
                    $this->quality = 0;
                if ($this->quality > 9)
                    $this->quality = 9;
                imagepng($new, $to, $this->quality);
                break;
            case 1: // gif
                imagegif($new, $to);
                break;
        }

        @chmod($to, 0644);

        return true;
    }

}

?>
