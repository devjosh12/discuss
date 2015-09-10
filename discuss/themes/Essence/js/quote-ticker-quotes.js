$(document).ready(function () {
        createTicker();
}); 

function createTicker(){
        //set the quotes array
        tickerItems = new Array(
        'Fun fact :-) Out of every 3 members at ForumIAS, one is the fairer sex. Be a decent human being. Be gender sensitive.',
        'To visit the Official Union Public Service Commission Website, logon to upsc.gov.in',
        'Want to drop a mail to ForumIAS? Mail us at forumias@gmail.com',
        '<a href="http://forumias.com/activity">Timeline</a> is the best place to share your views with the community, which is visible to all members. You can also post on an individual\'s wall and send them private messages by going to their profile. The <a href="http://forumias.com/discussions">discussions page</a> is for knowledge sharing and helping out each other.',
        'A champion is someone who gets up, even when he can\'t.<br/><b>-Anon</b>',
        'Being powerful is like being a lady. If you have to tell people you are, you aren\'t.<br/><b>Margaret Thatcher</b>',
        '"The problem is, you think you have time"',
        'ForumIAS Posting Rule #1: Treat other members the way you would like to be treated.',
        'ForumIAS Posting Rule #8: Avoid using block letters. BLOCK LETTERS ARE IRRITATING AND AMOUNT TO SHOUTING AT SOMEONE. Just like the previous statment :-)',
        'ForumIAS Posting Rule #9: Choose proper categories when you create a new topic. That will make the moderator\'s task easy.',
        '"The will is everything. If you make yourself more than just a man, if you devote yourself to an ideal, you become something else entirely.  Are you ready to begin?"',
        '"It\'s not who we are underneath, but what we do that defines us."',
        '"Why do we fall? So we can learn to pick ourselves back up."</br><b>Thomas Wayne</b>',
        '"Nothing in this world worth having comes easy"</br><b>Dr. Kelso</b>',
        'Doing the impossible is kinda fun</br><b>-Walt Disney</b>',
        '"Never underestimate the power of dreams, or the human person\’s ability to achieve even what seems impossible."',
        '<a href="http://www.flipkart.com/india-2013/p/itmdhzsh4eg3rez6?pid=9788123018362&affid=iastudymat"><u>India Year Book[click]</u></a> is now available on Flipkart, buy before it goes out of stock!',
        'Marie Curie, the Nobel prize winning scientist who discovered radium, died of radiation poisoning.',
        'The volume of the Earth\'s moon is the same as the volume of the Pacific Ocean.',
        'If you counted 24 hours a day, it would take 31,688 years to reach one trillion!',
        'ForumIAS Posting Rule #5: Do not start a new topic with "Help..". It says nothing about what your question is about.',
        'ForumIAS Posting Rule #7: Try to be objective, point-wise and succinct in your questions. Use roman numerals if required.',
        'ForumIAS Posting Rule #10: Use paragraphs. Don\'t post a monlithic paragraph-less block. It is difficult to read. You may leave a blank line after every paragraph.',
        'Press Note for Civil Services Mains 2012: <a href="http://upsc.gov.in/exams/interview-details/csm/2012/Press_Notes_CSM2012.pdf">Click here</a>',
        'Civil Services Mains 2012 Interviw Details: <a href="http://upsc.gov.in/exams/written-results/csm/2012/prnote&idx.htm#PageTop">Click here</a>'
        
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
        //$('#ticker').html(tickerItems[random]);

        //change with effect
        $('#ticker').fadeOut("slow", function(){
                $(this).html(tickerItems[random]).fadeIn("slow");
                // i++;
        });
        
        //repeat - change 5000 - time interval
        setTimeout(tickerIt, 15000);
}