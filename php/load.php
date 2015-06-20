<?php
include ("../bd.php");
session_start();

if(empty($_FILES['filename']) && $_FILES['filename']['size'] > 2*1024*1024)
{
    print( '<span style="color:red;">Объем файла превышает 2 мб или файл не удалось принять!</span><br>');
}
elseif (is_uploaded_file($_FILES['filename']['tmp_name']))
{
    $imginfo = getimagesize(realpath($_FILES['filename']['tmp_name']));
    if ($imginfo[2] == '1' || $imginfo[2] == '2' || $imginfo[2] == '3')
    {
        if ($imginfo[0] == '100' && $imginfo[1] == '100')
        {
            if ($imginfo[2] == '1')
            {
                $im = imageCreateFromGif(realpath($_FILES['filename']['tmp_name']));
                $w = imageSX($im);
                $h = imageSY($im);
                $w_new=40;
                $h_new=40;
                $im_mini = imageCreate($w_new, $h_new);
                imageCopyResized($im_mini, $im, 0, 0, 0, 0, $w_new, $h_new, $w, $h);
                if ($im && $im_mini)
                {
                    imageJpeg($im, $_SERVER['DOCUMENT_ROOT'].'/ava/'.$_SESSION['uid'].'.jpg', 90);
                    imageJpeg($im_mini, $_SERVER['DOCUMENT_ROOT'].'/avatars/mini_'.$_SESSION['uid'].'.jpg', 90);
                    imageDestroy($im);
                    imageDestroy($im_mini);
                    $sql = mysql_query("UPDATE usr SET ava='".$_SESSION['uid'].".jpg' WHERE id='".$_SESSION['uid']."'");
                    if ($sql)
                    {
                        print( '<span style="color:green;">Аватар успешно загружен!</span><br>');
                    }
                }
                else print( '<span style="color:red;">Загруженный вами файл не является изображением!</span><br>');
               
            }
            elseif ($imginfo[2] == '2')
            {
                $im = imageCreateFromJpeg(realpath($_FILES['filename']['tmp_name']));
                $w = imageSX($im);
                $h = imageSY($im);
                $w_new=40;
                $h_new=40;
                $im_mini = imageCreate($w_new, $h_new);
                imageCopyResized($im_mini, $im, 0, 0, 0, 0, $w_new, $h_new, $w, $h);
                if ($im && $im_mini)
                {
                    imageJpeg($im, $_SERVER['DOCUMENT_ROOT'].'/image/recipe/'.$_SESSION['id'].'.jpg', 90);
                    imageJpeg($im_mini, $_SERVER['DOCUMENT_ROOT'].'/image/recipe/mini/'.$_SESSION['id'].'.jpg', 90);
                    imageDestroy($im);
                    imageDestroy($im_mini);
                    
                    $sqlstr = mysql_query("UPDATE recipe SET image='".$_SESSION['id'].".jpg' WHERE id='".$_SESSION['id']."'");
                    if ($sqlstr)
                    {
                        print( '<span style="color:green;">Аватар успешно загружен!</span><br>');
                    }
                }
                else print( '<span style="color:red;">Загруженный вами файл не является изображением!</span><br>');
               
            }
            elseif ($imginfo[2] == '3')
            {
                $im = imageCreateFromPng(realpath($_FILES['filename']['tmp_name']));
                $w = imageSX($im);
                $h = imageSY($im);
                $w_new=40;
                $h_new=40;
                $im_mini = imageCreate($w_new, $h_new);
                imageCopyResized($im_mini, $im, 0, 0, 0, 0, $w_new, $h_new, $w, $h);
                if ($im && $im_mini)
                {
                    imageJpeg($im, $_SERVER['DOCUMENT_ROOT'].'/ava/'.$_SESSION['uid'].'.jpg', 90);
                    imageJpeg($im_mini, $_SERVER['DOCUMENT_ROOT'].'/ava/mini_'.$_SESSION['uid'].'.jpg', 90);
                    imageDestroy($im);
                    imageDestroy($im_mini);
                    $sql = mysql_query("UPDATE users SET avatar='".$_SESSION['uid'].".jpg' WHERE id='".$_SESSION['uid']."'");
                    if ($sql)
                    {
                        print('<span style="color:green;">Аватар успешно загружен!</span><br>');
                    }
                }
                else print('<span style="color:red;">Загруженный вами файл не является изображением!</span><br>');
            }
        }
        else print('<span style="color:red;">Изображение должно иметь размеры 100x100!</span><br>');
    }
    else print('<span style="color:red;">Не верный тип файла!<br>Поддерживаемые типы: jpg, png</span><br>');
}
else print('<span style="color:red;">Возникла ошибка при загрузке изображения! Попробуйте снова.</span><br>');