<?php
//////////////////////////////////////////////////////////////////
//                                                              //
//  This script demonstrates how to use a file uploader.        //
//                                                              //
//  You will need a directory named upload_images to use it.    //
//                                                              //
//////////////////////////////////////////////////////////////////

//set this to true to see debug info
$debug = false;

//set this to true to enforce strict error reporting
$error_reporting = false;

//lets make use of a few globals
//we need a directory to store the file
$uploadFileDir = "images/";
$timestamp = time();
//set the error reporting status for the script
if(!$error_reporting)
{
    error_reporting(E_ALL ^ E_NOTICE);
}

//here we check if the upload form has been posted
if(isset($_POST['submitted']))
{
    $submitted = $_POST['submitted'];
}

//here we check if the delete form has been posted
if(isset($_POST['deleted']))
{
    $deleted = $_POST['deleted'];
}

//if the upload form was submitted
if($submitted)
{
    //grab all the post variables from the $_POST array
    foreach($_POST as $varname => $varvalue)
    {
        $postNames.= $varname.",";
        $postVals.= $varvalue.",";
    }

    //uploaded files have their own global array named $_FILES
    //here are some of the important properties so grab these, also
    //notice the use of 'upload_images' this is the name
    //of the file input control in our form i.e. upload_images[]
    $fname = $_FILES['upload_images']['name'][0];
    $ftype = $_FILES['upload_images']['type'][0];
    $fsize = $_FILES['upload_images']['size'][0];
    $tmpName = $_FILES['upload_images']['tmp_name'][0];

    //if you are in debug mode then check to see what the varibles are set to
    if($debug)
    {
        echo "Post Names = ".$postNames."<br />";
        echo "Post Values = ".$postVals."<br />";
        echo "File Name = ".$fname."<br />";
        echo "File Type = ".$ftype."<br />";
        echo "File Size = ".$fsize."<br />";
        echo "File Temp Name = ".$tmpName."<br />";
    }

    //ok so the form has been submitted so validate what has been submitted
    if(validUpload())   //validUpload() is a function which checks the submission see below
    {
        //ok it's valid so upload the file see uploadFile() below
        uploadFile($fname);
    }

}
$image_url = "$uploadFileDir$timestamp$uploadFileName";
$uploaded_file_name = "$timestamp$uploadFileName";

//if the delete form was submitted
if($deleted)
{
    //first check there is something there
    if(file_exists($uploadFileDir.$timestamp.$uploadFileName))
    {
        //ok so unlink it
        unlink($uploadFileDir.$timestamp.$uploadFileName);
    }
}



function uploadFile($fname)
{
    //globals need to be defined in order to bring them into scope
    global $uploadFileDir, $timestamp, $uploadFileName;


    //set a few constants here for our test
    $maxImageWidth = 150;
    $maxImageHeight = 150;

    //fname is the name of the file on the client machine
    //which we retrieved earlier from the $_FILES array and passed it to this function
    if($fname)
    {
        //we need to have a relative path to finally save the file
		$uploadfile = $uploadFileDir.$timestamp.$uploadFileName;     
		//set the image quality
        $imagequality = 100;

        //there are 2 steps to an upload
        //firstly the file is uploded to a temp folder on the server with a temp name
        //so we need to get that name from the server
        //secondly the file is then moved to where we finally want to put it i.e. our relative path
        //so between these steps we can resize if if neccessary
        //so we need the temp name and we get this from the $_FILES array
        $tempFile = $_FILES['upload_images']['tmp_name'][0];

        //here we get the dimensions of the file
        $dimensions = GetImageSize($tempFile);

        //and set our width and height variables
        $image_width = $dimensions[0];
        $image_height = $dimensions[1];

        //now we need a ratio to determine which is larger the width or the height
        $image_ratio = ($image_width / $image_height);

        //now we determine which is larger and set the resize dimensions
        if($image_width >= $image_height)
        {
            $resize_width = $maxImageWidth;
            $resize_height = ceil($resize_width / $image_ratio);
        }
        else
        {
            $resize_height = $maxImageHeight;
            $resize_width = ceil($resize_height * $image_ratio);
        }

        //here we create a new image from the temp file
        $src = ImageCreateFromJpeg($tempFile);

        //we first test to see which graphics module of php is on the server
        //GD or GD2 which is much better and on later servers. "ImageCopyResampled()" is in GD2.
        if(function_exists("ImageCopyResampled"))
        {
            //using GD2
            //here we need another image for the new size
            $resized_image = ImageCreateTrueColor($resize_width, $resize_height);

            //now we copy our oringinal image into our final image and set the dimensions
            ImageCopyResampled($resized_image, $src, 0, 0, 0, 0, $resize_width, $resize_height, $image_width, $image_height);
        }
        else
        {
            //using GD
            //here we need another image for the new size
            $resized_image = ImageCreate($resize_width, $resize_height);

            //now we copy our oringinal image into our final image  and set the dimensions
            ImageCopyResized($resized_image, $src, 0, 0, 0, 0, $resize_width, $resize_height, $image_width, $image_height);
        }

        //finally we save it to our destination
        if(ImageJpeg($resized_image, $uploadfile, $imagequality))
        {
            echo "<center><span class=\"blue\"><h3>Upload was successful.</h3></span></center><br />";
        }
        else
        {
            echo "<center><span class=\"red\"><h3>Upload failed!</h3></span></center><br />";
        }

        //now destroy the file held in memory
        ImageDestroy($resized_image);
    }
}

function validUpload()
{
    //boolean return value
    $retVal = true;

    //the $_FILES array is global as per the $_POST array
    //so here we can get the properties of the file
    $fname = $_FILES['upload_images']['name'][0];
    $ftype = $_FILES['upload_images']['type'][0];
    $fsize = $_FILES['upload_images']['size'][0];

    //set a maximum size
    $maxFileSize = $_POST['MAX_FILE_SIZE'];

    //start our error string
    $errorString = "The following error occurred:<br />";

    //now a few tests
    //check to see if there is a file there is not return false
    if($fname == "")
    {
        return false;
    }

    // versions of IE prior to 9 treat all JPEGS as progressive eg. "image/pjpeg"
    //so first check the browser to see if it is IE_old
    if(getBrowser() == 'ie_old')
    {
        if($ftype != "image/pjpeg") //IE prior to version 10 treated all images as progressive jpegs
        {
            $errorString.= "Image must be saved as a JPEG no larger than 2Mb.<br />";
            $retVal = false;
        }
    }
    else
    {
        if($ftype != "image/jpeg") //test if it is a JPEG for the others
        {
            $errorString.= "Image must be saved as a JPEG no larger than 2Mb.<br />";
            $retVal = false;
        }
    }

    //now check the size
    if($fsize > $maxFileSize) //test if it is the right size
    {
        $errorString.= "Image size must not exceed 2Mb.<br />";
        $retVal = false;
    }

    //if there was an error then the return value would be set to false.
    if(!$retVal)
    {
        //output the error
        echo "<table align= \"center\" border=\"0\"><tr><td><span class=\"red\"><h3>".$errorString."</h3></span></td></tr></table>";
    }

    //return the outcome of the function
    return $retVal;
}

function getBrowser()
{
    if(preg_match("/opera/i",$_SERVER["HTTP_USER_AGENT"]))
    {
        $browser = "opera";
    }
    else if(preg_match("/firefox/i",$_SERVER["HTTP_USER_AGENT"]))
    {
        $browser = "firefox";
    }
    else if(preg_match("/msie.[4|5|6|7|8|9]/i",$_SERVER["HTTP_USER_AGENT"]))
    {
        $browser = "ie_old";
    }
    else if(preg_match("/msie.[10|11|12]/i",$_SERVER["HTTP_USER_AGENT"]))
    {
        $browser = "ie_new";
    }	
    else if(preg_match("/nav/i",$_SERVER["HTTP_USER_AGENT"]) ||
        preg_match("/Mozilla\/4\./", $_SERVER["HTTP_USER_AGENT"]))
    {
        $browser = "netscape";
    }
    else if(preg_match("/chrome/i",$_SERVER["HTTP_USER_AGENT"]))
    {
        $browser = "chrome";
    }
    else if(preg_match("/safari/i",$_SERVER["HTTP_USER_AGENT"]))
    {
        $browser = "safari";
    }
    else
    {
        $browser = "other";
    }
    return $browser;
}

?>