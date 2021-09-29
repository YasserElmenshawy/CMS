 
     $(document).ready(function(){
           
        ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
           console.error( error );
      } );   
           
           
        
  });
       
    
       $(document).ready(function(){
          
       $('#selectallbox').click(function(event){
            if(this.checked){
           $('.checkbox').each(function(){
               this.checked = true;
           });
       }else{
              $('.checkbox').each(function(){
               this.checked = false;

       
         });
           
       }
        });
       });
       
    