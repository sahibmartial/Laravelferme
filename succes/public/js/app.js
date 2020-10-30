var list_cmd_ra = '<?php echo json_encode($result);?>';
       var list_array=JSON.parse(list_cmd_ra);
       const input = document.querySelector('#campagne_id');
       const suggestions = document.querySelector('.suggestions ul');
     //   alert(list_cmd_ra);
      function search(str) {
        let results = [];
        const val = str.toLowerCase();
        if(str.length>=4){
            for (var i = 0; i <list_array.length; i++) {
                if (list_array[i].toLowerCase().indexOf(val) >-1) {
                    if (results.length<=30) {
                        results.push(list_array[i]);
                    }else{
                      //  alert('hello');
                        //results.push('true');
                        var msg='true';
                        results.push(msg);
                    }

                }
            }
        }
        return results;
    }

    function searchHandler(e) {
          const inputVal = e.currentTarget.value;
          let results = [];
          if (inputVal.length > 0) {
              results = search(inputVal);
          }
          showSuggestions(results, inputVal);
      }


      function showSuggestions(results, inputVal) {

        suggestions.innerHTML = '';

        if (results.length > 0) {
            for (i = 0; i < results.length; i++) {
                let item = results[i];
                // Highlights only the first match
                // TODO: highlight all matches
                const match = item.match(new RegExp(inputVal, 'i'));
                item = item.replace(match[0], `<strong>${match[0]}</strong>`);
                suggestions.innerHTML += `<li>${item}</li>`;
            }
            suggestions.classList.add('has-suggestions');
        } else {
            results = [];
            suggestions.innerHTML = '';
            suggestions.classList.remove('has-suggestions');
        }
    }

    function useSuggestion(e) {
          input.value = e.target.innerText;
          input.focus();
          suggestions.innerHTML = '';
          suggestions.classList.remove('has-suggestions');
      }

      input.addEventListener('keyup', searchHandler);
      suggestions.addEventListener('click', useSuggestion);
