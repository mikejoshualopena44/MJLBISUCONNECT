<?php

class Image
{   //To resize the image base on specified value to avoid maot na imge
    public function crop_img($original_file_name,$cropped_file_name,$max_width,$max_height)
    {
        if(file_exists($original_file_name))
        {
            $original_img = imagecreatefromjpeg($original_file_name);

            $original_width = imagesx( $original_img);
            $original_height = imagesy( $original_img);

            if($original_height > $original_width)
            {
                //if image is more on height crop height
                $ratio = $max_width / $original_width;

                $new_width = $max_width;
                $new_height = $original_height * $ratio;

            }else
            {
                //if image is more on width crop width
                $ratio = $max_height / $original_height;

                $new_height = $max_height;
                $new_width = $original_width * $ratio;

            }

        }
        //Only resize not cropted
        //crop height or crop width of the image
        $new_img = imagecreatetruecolor($new_width, $new_height);

        imagecopyresampled($new_img, $original_img,0,0,0,0, $new_width, $new_height, $original_width, $original_height);

        imagedestroy($original_img);
        if($new_height > $new_width)
        {
            $diff = ($new_height - $new_width);
            $y = round($diff/2);
            $x = 0;
        }else
        {
            $diff = ($new_width - $new_height);
            $x = round($diff/2);
            $y = 0;
        }

        $new_cropped_image = imagecreatetruecolor($max_width, $max_height);
        imagecopyresampled($new_cropped_image, $new_img, 0, 0, $x, $y, $max_width, $max_height,$max_width, $max_height);
        imagedestroy($new_img);

        imagejpeg($new_cropped_image, $cropped_file_name, 90);
    }
}


?>