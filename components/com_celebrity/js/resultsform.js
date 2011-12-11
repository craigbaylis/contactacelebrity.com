function overlimit()
{
    var num = max_image_uploads;
    var imageGroups = $$('.imagegroup');
    
    //check that the image groups exist
    if(imageGroups){
        
        //check if we are over the limit
         if (imageGroups.length < num){
            return false
         } else {
            return true;
         }
    
    } else {
        
        return true;
    }
        
}
/*
Public Method: buttonState
*/
function buttonState(state)
{
    if(state == 'hide'){
        $('addButton').setStyle('display','none');
    }
    if(state == 'show'){
        $('addButton').setStyle('display','block');
    }
}

/*
Public Method: emptyImageField
*/
function emptyImageField()
{
    var imageFields = $$('input[type=file]')
    for (i=0; i < imageFields.length; i++) {
        var field = imageFields[i].value;
        if (!field) {
            return true;
        }
        return false;
    }    
}
window.addEvent('domready',function(){

       var myForm = new FormCheck('result');
       
       //handle the success radio option on the form
       $('success').addEvent('click',function(){
            $('quality_id').set('disabled',false);
       });
       
       //handle clicking on any other radio option on the form
       $$(othersuccesses).addEvent('click',function(){
            $('quality_id').set('disabled',true);
       });
      
      
      if(!overlimit()) {
        
        //add button to add another image
        buttonState('show');
            
      } else {
        
        //hide the add image button
        buttonState('hide');
      }
        
      $('addButton').addEvent('click',function(e){
            
            //stop the default button behavior  
            e.stop();
            
            //check if there's already an empty image field
            if(emptyImageField()) {
                return;
            }

            //add extra image field
            var imageGroups = $$('.imagegroup')
            var numGroups = imageGroups.length;
            cloneSourceId = 'imagegroup' + String(numGroups);
            imageGroupSource = $('imagegroup1');
            
            var imageGroup = imageGroupSource.clone();
            imageGroup.inject(cloneSourceId,'after');
           
           //add the id's
           imageGroups = $$('.imagegroup');
           numGroups = imageGroups.length;
           imageIndex = numGroups - 1;
           var newId = 'imagegroup' + String(numGroups);
           imageGroups[imageIndex].set('id',newId);
           $$('#' + newId + ' ' + 'label[for=scannedimage1]').set('for','scannedimage' + String(numGroups));
           $$('#' + newId + ' ' + 'input[name=scannedimage1]').set('id','scannedimage' + String(numGroups));
           $$('#' + newId + ' ' + 'input[name=scannedimage1]').set('name','scannedimage' + String(numGroups));
           
           $$('#' + newId + ' ' + 'label[for=imagetitle1]').set('for','imagetitle' + String(numGroups));
           $$('#' + newId + ' ' + 'input[name=imagetitle1]').set('id','imagetitle' + String(numGroups));
           $$('#' + newId + ' ' + 'input[name=imagetitle1]').set('name','imagetitle' + String(numGroups));
           
           $$('#' + newId + ' ' + 'label[for=caption1]').set('for','caption' + String(numGroups)) 
           $$('#' + newId + ' ' + 'textarea[name=caption1]').set('id','caption' + String(numGroups));
           $$('#' + newId + ' ' + 'textarea[name=caption1]').set('name','caption' + String(numGroups));
           
           //clear the previous image value from the clone
           $(newId).set('html',$(newId).get('html')); 
           
           //set the required fields to be disabled
           $('imagetitle' + String(numGroups)).set('disabled',true);
           $('caption' + String(numGroups)).set('disabled',true);
           
           //add the event to handle enabling the title and caption fields when an image is selected
          $('scannedimage' + String(numGroups)).addEvent('change',function(){
            scannedimage = $('scannedimage' + String(numGroups));
            if(scannedimage.value != '') {
                $('imagetitle' + String(numGroups)).set('disabled',false);
                $('caption' + String(numGroups)).set('disabled',false);
            } else {
                $('imagetitle' + String(numGroups)).set('disabled',true);
                $('caption' + String(numGroups)).set('disabled',true);
            }
          });           
           //register the validation on the new field
           myForm.register($('imagetitle' + String(numGroups)));
           myForm.register($('caption' + String(numGroups)));
           
           if(overlimit()){
                buttonState('hide');
           }
        
      });
      //handle extra fields when an image is selected
      $('scannedimage1').addEvent('change',function(){
        scannedimage1 = $('scannedimage1');
        if(scannedimage1.value != '') {
            $('imagetitle1').set('disabled',false);
            $('caption1').set('disabled',false);
        } else {
            $('imagetitle1').set('disabled',true);
            $('caption1').set('disabled',true);
        }
      });
      /*
      \$('scannedimage2').addEvent('change',function(){
        scannedimage2 = \$('scannedimage2');
        if(scannedimage2.value != '') {
            \$('imagetitle2').set('disabled',false);
            \$('caption2').set('disabled',false);
        } else {
            \$('imagetitle2').set('disabled',true);
            \$('caption2').set('disabled',true);
        }
      }); */       
});