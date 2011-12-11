var celebSearch = function(event){
    
    // AJAX request        
    var newRequest = new Request.HTML({
        update:$('search_results'),
        data:{
            name:{first_name :$('first_name_search').value,last_name :$('last_name_search').value},
            controller: 'celebrity',
            step: '2',
            format: 'raw'  
        },
        url: 'index.php?option=com_celebrity&task=search',
        method:'post',
        onSuccess:function(){
         $('search_results').removeClass('loader');   
        }
    });
    
    //send the data
    newRequest.send();
}