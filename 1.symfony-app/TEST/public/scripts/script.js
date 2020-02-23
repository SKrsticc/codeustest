th = this.document.getElementsByTagName("th");

for(let c=0;c<th.length-1;c++)
{
    th[c].addEventListener('click', function(){sortTable(c);});
    th[c].onmouseover = function(){this.style.background = "#ccc"};
    th[c].onmouseleave = function(){this.style.background = "#fff"};
}

function sortTable(c) {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("myTable");
    switching = true;
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        // Start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /* Loop through all table rows (except the
        first, which contains table headers): */
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[c];//kolona za koju se sortira
            y = rows[i + 1].getElementsByTagName("TD")[c];
            // Check if the two rows should switch place:
            if(c==0)//name
            {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }else if(c==1){//price
                if (parseFloat(x.innerHTML) > parseFloat(y.innerHTML)) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }

        }
        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}

function deleteProduct(id){
    $(document).ready(function(){
        $.ajax({
            type:"DELETE",
            url:"/api/products/"+id,
            success: function(response){
                console.log('Success:' + response);
                document.getElementById(id).remove();//brisem iz UI
            },
            failure: function(response){
                console.log('Error: '+ response);
            }
        })
    });
}

