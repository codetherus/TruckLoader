<?php
class myAjaxCaller {
/**
 * Use to execute xajax methods without registering them. 
 * accept at least 2 params : 1- class name, 2- method name  
 *
 * @author lolek
 * @copyrights lolek
 * @website http://my.opera.com/superlolek/
 * @date 2009-07-02
 * @param void
 * @return xajaxResponse
 * 1/25/10 - Ed robinson modifications
 * The third parameter may be an include file i.e. "myclassfile" without the
 * .php extension.
 * If 3 or more params we now try to include the file if it exists.
 * When calling the user function we pass param array depending on 
 * whether we found an include. 
 */
public function callUser() {
    $r = new xajaxResponse(); //create xajax Response object
    try {
        $fNumArgs = func_num_args(); //get argument count....
        if($fNumArgs <2) //there should be at least 2 args, 1 is the class name, 2 is the method name
        {
            throw new Exception ('Insuffcient parameters count');
        }
        else
        {
            $fArgs = func_get_args();
            $cName = $fArgs[0]; //as above - class name
            $mName = $fArgs[1]; //method name (method should be of access type public!! 
                                //and return  xajaxResponse object!!
            //Ed's changes 1/26/10
            $bIncluded = false;
            if($fNumArgs >= 3) //args[2] may be the include file or a param
            {
              $fName = $fArgs[2].'.php';
              if (file_exists($fName))
              { 
                include($fName);
                $bIncluded = true;
              }
            }
            if (class_exists($cName))
            {
              $reflectObj = new ReflectionClass($cName); //create reflection object
              $cObj = $reflectObj->newInstance(); 
              if(!method_exists($cObj,$mName)) //if method doesn't exists, throw an error
              {
                 throw new Exception('unable to invoke specified method - doesn\'t exist');
              }
              if($fNumArgs==2) //if there are only 2 args, then the method will be invoked without
              {             // without any parameters
                  $r->loadCommands(call_user_func(array($cObj,$mName)));
              }
              else //if there are more than 2 parameters, then method will be invoked 
              {    //with  arguments specified while calling callUser     
                 if ($bIncluded === true)//Was an include loaded?
                  $r->loadCommands(call_user_func_array(array($cObj,$mName),array_slice($fArgs,3)));
                 else
                  $r->loadCommands(call_user_func_array(array($cObj,$mName),array_slice($fArgs,2)));
              }
            }
            else
            {
              throw new Exception('Class not found');
            }
        }

    } catch (Exception $e) {
        //catch exception and show error message 
        $r->alert($e->getMessage());
    }
    return $r; //return xajaxresponse object
}
} //End class...
?>
