        //tags_script
        // Get the tags and input elements from the DOM 
        const tags = document.getElementById('tags'); 
        const input = document.getElementById('input-tag'); 
  
        // Add an event listener for keydown on the input element 
        input.addEventListener('keydown', function (event) { 
  
            // Check if the key pressed is 'Enter' 
            if (event.key === 'Enter') { 
              
                // Prevent the default action of the keypress 
                // event (submitting the form) 
                event.preventDefault(); 
              
                // Create a new list item element for the tag 
                const tag = document.createElement('li'); 
              
                // Set the text content of the tag to the input value 
                tag.innerText = input.value; 
                let html = "<input type='hidden' name='tags[]' value='"+input.value+"'/>";
                $('.dynamic-field').append(html);
              
                // Append the tag to the tags list 
                tags.appendChild(tag); 
              
                // Clear the input element's value 
                input.value = ''; 
            } 
        }); 