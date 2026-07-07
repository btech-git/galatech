<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        
        
        
    </head>

    <body>
        <div class="container" id="page">

           
         
        <div id="content-memo">
                <?php echo $content; ?>
        </div><!-- content -->

          
        </div><!-- page -->

    </body>
    
    <script type="text/javascript">
	$(document).on("keypress", ".TabOnEnter" , function(e)
  {
    //Only do something when the user presses enter
    if( e.keyCode ==  13 )
    {
       var nextElement = $('[tabindex="' + (this.tabIndex+1)  + '"]');
       console.log( this , nextElement ); 
       if(nextElement.length )
         nextElement.focus()
       else
         $('[tabindex="1"]').focus();  
    }   
  });
  
  $(document).on("keypress", ".TabOnEnterHeader" , function(e)
  {
    //Only do something when the user presses enter
    if( e.keyCode ==  13 )
    {
       var nextElement = $('[tabindexHeader="' + (this.tabIndex+1)  + '"]');
       console.log( this , nextElement ); 
       if(nextElement.length )
         nextElement.focus()
       else
         $('[tabindexHeader="1"]').focus();  
    }   
  });


function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}

document.onkeypress = stopRKey;


</script>
</html>
