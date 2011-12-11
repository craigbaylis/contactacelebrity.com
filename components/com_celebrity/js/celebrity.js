//keep scrollbars from appearing in the lightbox
$('sbox-content').setStyle('overflow','hidden');

//set step 2 if continue button clicked
//$('continue').addEvent('click',function(){
//    $$('input[name=step]').setProperty('value','2');
//});

var subGo = function(event){
    
    // Stop the form from submitting
    event.stop();
    
    // AJAX request        
    var newRequest = new Request({
        url: 'index.php?option=com_celebrity&step=1&task=search',
        method:'post',
        onRequest: function(){
            $$('.field,#stepdesc').setStyle('visibility','hidden');
            $('fields').addClass('loading');  
        },
        onSuccess: function(response){          
               
            //update the page with the results
            //$('stepsfooter').setStyle('opacity',0);
            $('update').set('html',response);
            
            $('stepsfooter').setStyle('opacity',0);
            $('stepsfooter').tween('opacity',1);
                        
            //adjust the height of the lightbox to accomodate the response
            $('sbox-window').tween('height',$('addCelebForm').getSize().y + 10);
                        
        }
    });
    
    //send the form
    newRequest.send($('addCelebForm'));
}

var subContinue = function(event){
    
    // Stop the form from submitting
    event.stop();
    
    // AJAX request        
    var newRequest = new Request({
        url: 'index.php?option=com_celebrity&step=2&task=search',
        method:'post',
        onRequest: function(){
            $$('.field,#stepdesc,#stepsfooter').setStyle('visibility','hidden');
            $('fields').addClass('loading');  
        },
        onSuccess: function(response){          
               
            //update the page with the results
            //$('stepsfooter').setStyle('opacity',0);
            $('update').set('html',response);
            
            $('stepsfooter').setStyle('opacity',0);
            $('stepsfooter').tween('opacity',1);
                        
            //adjust the height of the lightbox to accomodate the response
            $('sbox-window').tween('height',$('addCelebForm').getSize().y + 10)
                        
        }
    });
    
    //send the form
    newRequest.send($('addCelebForm'));
}
    
$('update').addEvent('click:relay(#go)', subGo);
$('update').addEvent('click:relay(#continue)', subContinue);

