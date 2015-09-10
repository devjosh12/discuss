$(document).ready(function () {
        createTicker();
}); 

function createTicker(){
        //set the quotes array
        tickerItems = new Array(
        'With the weightage of General Studies being exponentially raised,  <a href="http://www.flipkart.com/india-2013/p/itmdhzsh4eg3rez6?pid=9788123018362&affid=iastudymat"><b><u>order India Year Book 2013[click]</u></b></a> before it goes out of stock again!',
        'Students with <u>no background in Economics</u> and struggling with Indian Economy should check out <a href="http://www.flipkart.com/indian-economy-4th/p/itmdfgb8bvemvqvw?pid=9781259003844&affid=iastudymat"><b><u>Indian Economy by TMH[click]</u></b></a>.',
        '<b><u><a href="http://is.gd/Economic_Survey_2013">The latest Economic Survey</a></u></b> would be *the* most essential books for Civil Services Examination\'s all three stages. It is now available for <b><u><a href="http://is.gd/Economic_Survey_2013">pre-order at Flipkart[click]</a></u></b> for <b>20% off</b>. Pre-order it now to get it as soon as it is available in print with discount. ',
        '"The problem is, you think you have time"'
        );
        i = 0;
        tickerIt();
}

function tickerIt(){
        if( i == tickerItems.length ){
                i = 0;
        }
        var max = tickerItems.length-1;
	var min = 0;
	var random = Math.floor((Math.random() * ((max + 1) - min)) + min);
        //change without effect
        //$('#bookticker').html(tickerItems[random]);

        //change with effect
        $('#bookticker').fadeOut("slow", function(){
                $(this).html(tickerItems[random]).fadeIn("slow");
                // i++;
        });
        
        //repeat - change 5000 - time interval
        setTimeout(tickerIt, 15000);
}