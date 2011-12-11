//keep scrollbars from appearing in the lightbox
$('sbox-content').setStyle('overflow','hidden');

//set step 2 if continue button clicked
//$('continue').addEvent('click',function(){
//    $$('input[name=step]').setProperty('value','2');
//});

var submitCeleb = new Form.Request($('addCelebForm'), $('update'), {
    requestOptions: {
        useSpinner: false    
    },
    onSend: function(){
        //hide the fields and show the spinner
        $$('.field,#stepdesc').setStyle('visibility','hidden');
        $('fields').addClass('loading');  
    },
    
    onSuccess: function(response){                      
        //fade in the results that were updated
        $('stepsfooter').setStyle('opacity',0);
        $('stepsfooter').tween('opacity',1);
                        
        //adjust the height of the lightbox to accomodate the results
        $('sbox-window').tween('height',$('addCelebForm').getSize().y + 10)
    }
});

//submitCeleb.disable();

$('update').addEvent('click:relay(#go)', function(){
    submitCeleb.enable();
    //submitCeleb.send();
});
//$('update').addEvent('click:relay(#continue)', subCeleb);

