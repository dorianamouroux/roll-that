var progress = $("#progress");
var result_img = $("#result_img");
var placeholder_result = $("#placeholder_result");
var box_upload = $("#box_upload");
var text_upload = $("#text_upload");

var i = 0;
function print_object(obj, type)
{
    if (type)
    {
		for (prop in obj)
			console.log(prop +  " => " + obj[prop]);
	}
	 else
    {
	  	var props = "";
	 	for (prop in obj)
            props += prop +  " => " + obj[prop] + "\n";
        console.log(props);
    }
}

function alerte_error(message)
{
	$("#error_message").html(message);
	$("#error").css('display', 'block');
}

function close_error(message)
{
	$("#error").css('display', 'none');
}

function print_image()
{
	result_img.css('backgroundImage', "url('image.php?"+Math.random()+"')");
	result_img.css('display', "block");
	placeholder_result.css('display', "none");
}

$(function() {
    // pour que toute la zone soit clickable
    $(".box_upload").mousemove(function(e) {
        var offL, offR, inpStart;
        offL = $(this).offset().left;
        offT = $(this).offset().top;
        aaa = $(this).find("input").width() / 2;
        $(this).find("input").css({
            left:e.pageX - offL - aaa - 20,
            top:e.pageY - offT - 20
        });
    });
    
    // upload en AJAX
    $('#upload').fileupload({
        add: function (e, data) {
            var jqXHR = data.submit();
			result_img.css('display', "none");
			placeholder_result.css('display', "block");
			progress.css('display', 'block');
			progress.css('width', '0');
        },
        progress: function(e, data) {
		 	var n = parseInt(data.loaded / data.total * 100, 10);
			progress.css('width', n+'%');
		},
		fail: function(e, data) {
            alerte_error('error d\'upload, réessayez plus tard');
			print_object(e);
			print_object(data);
        },
        done: function(e, data) {
			progress.css('display', 'none');
			if (data.result == 'ok')
			{
				print_image();
			}
			else
				alerte_error(data.result);
        }
    });
});

function dumb_user()
{
    var red = "#F44336";
    var grey = "#575757";
    var delay = 150;
    var limit = 3;

    setTimeout(function () { 
        box_upload.css('borderColor', red);
        text_upload.css('color', red);
        setTimeout(function () { 
            box_upload.css('borderColor', grey);
            text_upload.css('color', grey);
            if (i < (limit - 1))
            {
                i++;
                dumb_user();
            }
            else
                i = 0;
        }, delay);
    }, delay);
}