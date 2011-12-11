window.addEvent('domready',function(){
   
   var myForm = new FormCheck('mailingForm', {validateDisabled:true});
               function customCheck(el){
                if (!el.value.test(/^[A-Z]/)) {
                    el.errors.push("Username should begin with an uppercase letter");
                    return false;
                } else {
                    return true;
                }
            } 
    
   $('addTempVenue').addEvent('change',function(){
       if(this.value == 'Yes'){
           //add validation to dates
           $$('#addVenueStart, #addVenueEnd').addClass('validate[\'required\']');
           myForm.register($('addVenueStart'));
           myForm.register($('addVenueEnd'));
       }else{
           //remove validation from dates
          $$('#addVenueStart, #addVenueEnd').removeClass('validate[\'required\']');
          myForm.dispose($('addVenueStart'));
          myForm.dispose($('addVenueEnd'));
       }
       
   });
   var loadStates = function(){
                        var country_id = this.get('value');
                        //var states = $('addState');
                        new Request.HTML({
                            url: 'index.php?option=com_celebrity&view=address&layout=states&format=raw&controller=address&country_id='+country_id,
                            update: $('addState'),
                            onRequest: function(){
                                $('addState').set('disabled', 'disabled');
                                $('loadingStates').setStyle('visibility','visible');
                            },
                            onComplete: function(){
                                //enable dropdrop
                                $('addState').erase('disabled');
                                
                                //Check if we have states to display or the fill in option
                                if (($('addState').get('value') == ('other')) && !$('addOtherState')) {
                                    //add the extra fill-in text box
                                     var fillbox = new Element('input',{
                                        type: 'text',
                                        id: 'addOtherState',
                                        name:'addOtherState',
                                        value: '',
                                        'class': 'validate[\'required\']'
                                    });
                                    fillbox.inject($('addState'),'after');
                                    
                                    //add validation
                                    myForm.register($('addOtherState'));

                                } else if (($('addState').get('value') != ('other')) && $('addOtherState')) {
                                    //remove the validation from the fill-in text box
                                    myForm.dispose($('addOtherState'));
                                    
                                    //remove the extra text box
                                    $('addOtherState').destroy();
                                    
                                    //add validation to dropdown
                                    $('addState').addClass('validate[\'required\']');
                                    
                                } else {
                                    
                                }
                                
                                $('loadingStates').setStyle('visibility','hidden');
                            }
                        }).send();
                    };
	
	//display mailing form
	$('mailing').addEvent('click',function(){	
        
        //get the celebrity's id from the current url
        var currentURL = new URI();
        var cid = currentURL.getData('cid');
        var celebName = $('celebName').value;
		
        //load form
		new Request.HTML({
            method: 'post',
            data:'celebName='+celebName,			
            onRequest: function(){
				//clear current form
				$('addressForm').set('html','');
				//set spinner
				$('addressForm').addClass('loader');		
			},
			onComplete: function(){
				//remove spinner
				$('addressForm').removeClass('loader');
                
                //add form validation
                 var myForm = new FormCheck('mailingForm', {validateDisabled:true});
			},
            onSuccess: function(){     
                //load list of states based on country selection
                $('addCountry').addEvent('change', loadStates );
            },
			url: 'index.php?option=com_celebrity&view=address&layout=mailing&format=raw&controller=address&cid='+cid,
			update: $('addressForm')
		}).send();
	});
	
	//display email form
	$('email').addEvent('click',function(){

        //get the celebrity's id from the current url
        var currentURL = new URI();
        var cid = currentURL.getData('cid');
        var celebName = $('celebName').value;
        
        //load form
        new Request.HTML({
            method: 'post',
            data:'celebName='+celebName,            
            onRequest: function(){
                //clear current form
                $('addressForm').set('html','');
                //set spinner
                $('addressForm').addClass('loader');        
            },
            onComplete: function(){
                //remove spinner
                $('addressForm').removeClass('loader');
                
                //add form validation
                var myForm = new FormCheck('emailForm', {validateDisabled:true});
            },
            url: 'index.php?option=com_celebrity&view=address&layout=email&format=raw&controller=address&cid='+cid,
            update: $('addressForm')
        }).send();		
	
	});
 	
	//display website form
	$('website').addEvent('click',function(){

        //get the celebrity's id from the current url
        var currentURL = new URI();
        var cid = currentURL.getData('cid');
        var celebName = $('celebName').value;
               
        //load form
        new Request.HTML({
            method: 'post',
            data:'celebName='+celebName,            
            onRequest: function(){
                //clear current form
                $('addressForm').set('html','');
                //set spinner
                $('addressForm').addClass('loader');        
            },
            onComplete: function(){
                //remove spinner
                $('addressForm').removeClass('loader');
                
                //add form validation
                var myForm = new FormCheck('websiteForm', {validateDisabled:true});
            },
            url: 'index.php?option=com_celebrity&view=address&layout=website&format=raw&controller=address&cid='+cid,
            update: $('addressForm')
        }).send();	
	});
    
    //load list of states based on country selection
    if ($('country_id')) {
        $('country_id').addEvent('change', loadStates );
    }
    
    //add box to add additional states
    if ($('addState')) {
        var addState = $('addState');
        addState.addEvent('change',function(){
        
        //Check if the user wants to add a state
        if (($('addState').get('value') == ('other')) && !$('addOtherState')) {
            //add the extra fill-in text box
             var fillbox = new Element('input',{
                type: 'text',
                id: 'addOtherState',
                name:'addOtherState',
                value: '',
                'class': 'validate[\'required\']'
            });
            fillbox.inject($('addState'),'after');
            
            //add validation
            myForm.register($('addOtherState'));

        } else if (($('addState').get('value') != ('other')) && $('addOtherState')) {
            //remove the validation from the fill-in text box
            myForm.dispose($('addOtherState'));
            
            //remove the extra text box
            $('addOtherState').destroy();
            
            //add validation to dropdown
            $('addState').addClass('validate[\'required\']');
            
        } else {
            
        }            
            
        });    
    }
		
});