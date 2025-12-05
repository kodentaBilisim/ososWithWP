function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds) {
            break;
        }
    }
}

function hata_alert(text) {
    Swal.fire({
        title: "İşlem Başarısız!", text: text, icon: "error", showConfirmButton: !1, showCloseButton: !0
    })
}

function basari_alert(text) {
    Swal.fire({
        title: "İşlem Başarılı", text: text, icon: "success", showConfirmButton: !1, showCloseButton: !0
    })
}

$(document).ready(function () {
    (function ($) {
        $.fn.serializeFormJSON = function () {
            var o = {};
            var a = this.serializeArray();
            $.each(a, function () {
                if (o[this.name]) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };
    })(jQuery);

    $('form#serialize').submit(async function (e) {
        e.preventDefault();
        var data = $(this).serializeFormJSON();
        var submitbtn = $('#btn-' + data.token);
        submitbtn.html('İşleniyor...');
        submitbtn.prop('disabled', true);


        let url = "api/" + data.postUrl + '.php';

        // await new Promise(r => setTimeout(r, 500));
        var ajaxpost = true;


        if (data.upload && sessionStorage.getItem(data.token) === null) {

            var filedata = await uploadfiles(data.upload)
            if (!filedata.hata) {
                data.fileID = filedata.fileID;
                sessionStorage.setItem(data.token, data.fileID);
                ajaxpost = true;
            }
        } else {
            if (sessionStorage.getItem(data.token)) {
                data.fileID = sessionStorage.getItem(data.token);
                ajaxpost = true;
            }
        }


        if (data.filesCustom) {
            var filedata = await uploadfilesCustom(data.filesCustom)
            if (!filedata.hata) {
                data.fileUUID = filedata.uuid;
                sessionStorage.setItem(data.token, data.fileUUID);
                ajaxpost = true;
            }
        } else {
            if (sessionStorage.getItem(data.token)) {
                data.fileUUID = sessionStorage.getItem(data.token);
                ajaxpost = true;
            }
        }


        if (ajaxpost) {
            await $.ajax({
                type: 'POST', url: url, dataType: 'json', data: data, success: function (msg) {
                    ajaxReturn(msg, submitbtn, data)
                }, error: function (msg) {
                    hata_alert('Bir hata meydana geldi!');
                    submitbtn.html('<i class="ri-error-warning-line label-icon align-middle fs-16 me-2 "></i>Hata Oluştu!');
                    submitbtn.prop('disabled', false);
                }
            });
        } else {
            submitbtn.html('<i class="ri-error-warning-line label-icon align-middle fs-16 me-2 "></i>Hata Oluştu!');
        }
        submitbtn.prop('disabled', false);
    });


});


function processConfirm(fName, token, data, textonay = null) {


    title = 'İşleme devam etmek istiyor musunuz?'
    if (textonay === null) {
        text = 'Bu işlem geri alınamaz!'
    } else {
        text = textonay;
    }

    ButtonText = 'Evet, Devam et'

    Swal.fire({
        title: title,
        text: text,
        icon: "warning",
        showCancelButton: !0,
        confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
        cancelButtonClass: "btn btn-danger w-xs mt-2",
        confirmButtonText: ButtonText,
        cancelButtonText: 'İptal',
        buttonsStyling: !1,
        showCloseButton: !0
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "İşlem Başarılı!",
                text: "",
                icon: "success",
                confirmButtonClass: "btn btn-primary w-xs mt-2",
                buttonsStyling: !1
            })
            let data2 = window[fName](data, token);
        }
    })

}


async function userDelete(data, token) {


    let form_data = "";

    form_data = new FormData();
    form_data.append("UserID", data.UserID);
    form_data.append('token', token);

    await $.ajax({
        url: 'api/users/delete.php',
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        dataType: 'json',
        data: form_data,
        type: 'POST',
        success: function (msg) {

            //location.reload();
            ajaxReturn(msg, null, null)

        },
        error: function (msg) {
            hata_alert('Bir hata meydana geldi!');
            btn.prop('disabled', false);
        }
    });

}


async function deleteItems(data, token) {

    console.log(data)

    data.token = token;

    await $.ajax({
        type: 'POST', url: 'api/' + data.url, dataType: 'json', data: data, success: function (msg) {
            if (msg.hata) {
                hata_alert(msg.hata);
                if (msg.operation === 'reload') {
                    if (msg.sleep) {
                        setTimeout(function () {
                            location.reload();
                        }, msg.sleep);
                    } else {
                        location.reload();
                    }
                }
                if (msg.operation === 'redirect') {
                    if (msg.sleep) {
                        setTimeout(function () {
                            window.location.assign(msg.location);
                        }, msg.sleep);
                    } else {
                        window.location.assign(msg.location);
                    }
                }
                submitbtn.html('<i class="ri-error-warning-line label-icon align-middle fs-16 me-2 "></i>Hata Oluştu!');


            } else {
                sessionStorage.removeItem(data.token);
                console.log(msg.popup)
                if (msg.popup === true) {
                    basari_alert(msg.basari);
                }
                if (msg.operation === 'reload') {
                    if (msg.sleep) {
                        setTimeout(function () {
                            location.reload();
                        }, msg.sleep);
                    } else {
                        location.reload();
                    }
                }
                if (msg.operation === 'redirect') {
                    if (msg.sleep) {
                        setTimeout(function () {
                            window.location.assign(msg.location);
                        }, msg.sleep);
                    } else {
                        window.location.assign(msg.location);
                    }
                }
                if (msg.operation === 'none') {
                    if (data.callbackfun) {
                        window[data.callbackfun](msg);
                    }
                    if (msg.url) {
                        $('input#url').val(msg.url);
                    }
                }
                submitbtn.html('<i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i>Başarılı');

            }
        }, error: function (msg) {

        }
    });


}


function isEmpty(obj) {
    for (var prop in obj) {
        if (obj.hasOwnProperty(prop)) return false;
    }

    return true;
}

async function uploadfiles(fileInputID) {

    let fileList = $('#' + fileInputID).prop("files");
    //console.log(fileList)
    let form_data = "";

    form_data = new FormData();
    form_data.append("file", fileList[0]);

    await $.ajax({
        url: "api/upload/upload.php",
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        dataType: 'json',
        data: form_data,
        type: 'POST',
        success: function (msg) {
            data = msg;
        },
        fail: function (res) {
            //reject(res);
        }
    })

    return data;

}

async function uploadfilesCustom(fileInputID) {

    let fileList = $('#' + fileInputID).prop("files");
    let form_data = "";
    form_data = new FormData();

    var totalfiles = document.getElementById(fileInputID).files.length;
    for (var index = 0; index < totalfiles; index++) {
        form_data.append("files[]", document.getElementById(fileInputID).files[index]);
    }


    // form_data.append("file", fileList[0]);

    await $.ajax({
        url: "api/upload/customupload.php",
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        dataType: 'json',
        data: form_data,
        type: 'POST',
        success: function (msg) {
            data = msg;

            console.log(data)

        },
        fail: function (res) {
            //reject(res);
        }
    })

    return data;

}


function progressbar(total, current) {

    var yuzde = (100 * current) / total;
    yuzde = yuzde.toFixed(2);
    $('.progress-bar').css('width', yuzde + '%');
    $('.progress-bar').text(yuzde + '%');

}

var hatalist = [];
var totaladd = 0;

async function useradd(count) {
    $('#useraddbtn').prop('disabled', true);
    var hataleg = hatalist.length;
    if (totaladd >= count) {

        basari_alert('Tümü eklendi!');

    } else {
        if (hataleg > 0) {

            for (i = 0; hatalist; i++) {
                progressbar(hataleg, i);
                if (i == hataleg) {

                    break;
                }
                var data = $('#formpers' + hatalist[i]).serializeFormJSON();

                $('.pers' + hatalist[i]).css("background-color", "white");

                var result = await $.ajax({
                    url: 'api/personel/ekle.php', type: 'POST', dataType: 'json', data: data
                });

                if (result.hata) {

                    $('.pers' + hatalist[i]).css("background-color", "red");
                    $('.toggle-' + hatalist[i]).show();
                    $('.toggle-' + hatalist[i] + ' .alert').html(result.hata);

                    //console.log('.toggle-' + hatalist[i] + ' .alert')

                    result.hata = '';


                } else {

                    $('.pers' + hatalist[i]).css("background-color", "#2ecc71");
                    $('.pers' + hatalist[i]).hide(1000);
                    removeItem = hatalist[i];
                    hatalist = $.grep(hatalist, function (value) {
                        return value != removeItem;
                    });

                    totaladd++;

                }
            }
        } else {

            var i = 1;
            while (i <= count) {
                progressbar(count, i);
                var data = $('#formpers' + i).serializeFormJSON();
                $('.pers' + i).css("background-color", "white");

                var result = await $.ajax({
                    url: 'api/personel/ekle.php', type: 'POST', dataType: 'json', data: data
                });

                if (result.hata) {

                    $('.pers' + i).css("background-color", "red");
                    $('.toggle-' + i).show();
                    $('.toggle-' + i + ' .alert').html(result.hata);
                    result.hata = '';
                    hatalist.push(i);


                } else {

                    $('.pers' + i).css("background-color", "#2ecc71");
                    $('.pers' + i).hide(1000);
                    totaladd++;

                }

                i++;

            }
        }
    }

    $('#useraddbtn').prop('disabled', false);

}

$(".changeListen").change(function () {
    if (this.dataset.changeid === this.value) {
        $('.sh-' + this.dataset.changeid).css('display', 'flex');
    } else {
        $('.sh-' + this.dataset.changeid).css('display', 'none');
    }
});


$(".noteList").change(function () {
    $("textarea#t-" + this.id).val(this.value);
});


function ajaxReturn(msg, submitbtn, data) {
    if (msg.hata) {
        hata_alert(msg.hata);
        if (msg.operation === 'reload') {
            if (msg.sleep) {
                setTimeout(function () {
                    location.reload();
                }, msg.sleep);
            } else {
                location.reload();
            }
        }
        if (msg.operation === 'redirect') {
            if (msg.sleep) {
                setTimeout(function () {
                    window.location.assign(msg.location);
                }, msg.sleep);
            } else {
                window.location.assign(msg.location);
            }
        }

        if (submitbtn !== null) {
            submitbtn.html('<i class="ri-error-warning-line label-icon align-middle fs-16 me-2 "></i>Hata Oluştu!');

        }


    } else {
        sessionStorage.removeItem(data.token);
        console.log(msg.popup)
        if (msg.popup === true) {
            basari_alert(msg.basari);
        }
        if (msg.operation === 'reload') {
            if (msg.sleep) {
                setTimeout(function () {
                    location.reload();
                }, msg.sleep);
            } else {
                location.reload();
            }
        }
        if (msg.operation === 'redirect') {
            if (msg.sleep) {
                setTimeout(function () {
                    window.location.assign(msg.location);
                }, msg.sleep);
            } else {
                window.location.assign(msg.location);
            }
        }
        if (msg.operation === 'none') {
            if (data.callbackfun) {
                window[data.callbackfun](msg);
            }
            if (msg.url) {
                $('input#url').val(msg.url);
            }
        }

        if (submitbtn !== null) {
            submitbtn.html('<i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i>Başarılı');
        }


    }
}

function getParam(param) {
    return new URLSearchParams(window.location.search).get(param);
}

async function uyeListProcess(uyeler) {
    uyeArr = Object.entries(uyeler);
    console.log(uyeArr)
    let i = 1;
    for (const uye of uyeArr) {

        if (i === 1) {
            i++;
            continue;
        }

        console.log(uye[1])


        await $.ajax({
            url: 'api/uye/ekle.php', type: 'POST', dataType: 'json', data: uye[1], success: function (msg) {
                progressbar(uyeArr.length, i);
                document.getElementById('counter').innerText = i;
            }
        });

        i++;


    }
}

async function uyeIstifaProcess(uyeler) {
    uyeArr = Object.entries(uyeler);
    console.log(uyeArr)
    let i = 1;
    for (const uye of uyeArr) {

        if (i === 1) {
            i++;
            continue;
        }

        console.log(uye[1])


        await $.ajax({
            url: 'api/uye/istifa.php', type: 'POST', dataType: 'json', data: uye[1], success: function (msg) {
                progressbar(uyeArr.length, i);
                document.getElementById('counter').innerText = i;
            }
        });

        i++;


    }
}


async function listUploadProcess(filename, ENDPOINT, objectIndex,rnd) {

    var ul = document.getElementById('sonuc')


    var datas = await loadJSON('/uploads/' + filename);
    let i = 1;
    let start = false;
    for (const data of Object.entries(datas)) {
        if (i === 1) {
            i++;
            continue;
        }
        console.log('LOCAL:',localStorage.getItem("lastITEM_" + ENDPOINT))
        console.log('MEVCUT:',data[1][objectIndex])

        if (localStorage.getItem("lastITEM_" + ENDPOINT) !== undefined && localStorage.getItem("lastITEM_" + ENDPOINT)) {
            if (data[1][objectIndex] == localStorage.getItem("lastITEM_" + ENDPOINT)) {
                start = true;
            }
        } else {
            start = true;
        }

        if (!start) {
            i++;
            continue;
        }

        if (i === 1) {
            i++;
            continue;
        }

        data[1].rnd = rnd;


        await $.ajax({
            url: 'api/' + ENDPOINT, type: 'POST', dataType: 'json', data: data[1], success: function (msg) {

                localStorage.setItem("lastITEM_" + ENDPOINT, msg.id);

                progressbar(Object.entries(datas).length, i);
                document.getElementById('counter').innerText = i;

                createli(msg,ul)



            }
        });
        i++;
    }
    localStorage.removeItem("lastITEM_" + ENDPOINT)
    if(ENDPOINT === 'uye/ekle.php'){
        deleteEskiUye(rnd)
    }
}

async function loadJSON(file) {

    console.log(file)
    let returnData;
    await $.getJSON(file, await function (data) {
        returnData = data;
    });
    return returnData;
}


function createli(data,ul){

    var li = document.createElement("li");
    var span = document.createElement("span");
    span.innerHTML = JSON.stringify(data);
    li.appendChild(span);
    ul.prepend(li);



}


async function deleteEskiUye(rnd){

    await $.ajax({
        url: 'api/uye/istifa-eski.php?rnd='+rnd, type: 'GET', dataType: 'json', success: function (msg) {

        }
    });

}




$('#ek').on('change', function (e) {
    var valueSelected = this.value;
    $('.eksecenek select').prop('disabled', true);
    $('.eksecenek').hide();
    $('.ek-' + valueSelected + ' select').prop('disabled', false);
    $('.ek-' + valueSelected).show();
});


var subeler = '';
var gorevler = '';
var temsilciler = '';
var gorevfirma = '';
var subekullanici = '';


/**/
$("#Allsubeler").click(function () {
    $('.sube:checkbox').not(this).prop('checked', this.checked);

    $(".genelgorev").show();
    $(".subegorev").show();
});

$("#Allgorevler2").click(function () {
    $('.gorevuser2:checkbox').not(this).prop('checked', this.checked);
});

$("#Allgorevler").click(function () {
    $('.gorev:checkbox').not(this).prop('checked', this.checked);
});

$("#Allfirmalar").click(function () {
    $('.firma:checkbox').not(this).prop('checked', this.checked);
});
$("#Allgorevlerfirma").click(function () {
    $('.gorevfirma:checkbox').not(this).prop('checked', this.checked);
});
/**/
$('.gorevfirma').click(function () {

    var str1 = $("#gorevlerfirma input[type='checkbox']").map(function () {

        if (this.checked == 1) {
            return '"' + this.name + '"';

        }

    }).get().join(",");


    gorevfirma = '"gorevfirma":[' + str1 + ']';
    var filter = "{" + firmalar + gorevfirma + "}";
    console.log(filter);
    var text = $('#filtre');
    text.val(filter);


});

$('.firma').click(function () {

    var str1 = $("#firmalar input[type='checkbox']").map(function () {

        if (this.checked == 1) {
            return '"' + this.name + '"';

        }

    }).get().join(",");


    firmalar = '"firmalar":[' + str1 + '],';
    var filter = "{" + firmalar + gorevfirma + "}";
    console.log(filter);
    var text = $('#filtre');
    text.val(filter);
    $("#gorevlerfirma").show();


});


$('.sube').click(function () {

    var str1 = $("#subeler input[type='checkbox']").map(function () {

        if (this.checked == 1) {
            return '"' + this.name + '"';

        }

    }).get().join(",");


    subeler = '"subeler":[' + str1 + '],';
    var filter = "{" + subeler + gorevler + "}";
    console.log(filter);
    var text = $('#filtre');
    text.val(filter);
    $("#gorevler").show();


});

$('.subekullanici').click(function () {

    var str1 = $("#subelerkullanici input[type='checkbox']").map(function () {

        if (this.checked == 1) {
            return '"' + this.name + '"';

        }

    }).get().join(",");


    subekullanici = '"subeler":[' + str1 + ']';
    var filter = "{" + subekullanici + "}";
    console.log(filter);
    var text = $('#filtre');
    text.val(filter);


});

$('.genelmerkez').click(function () {

    $(".genelgorev").show();


});


$('.gorev').click(function () {


    var str1 = $("#gorevler input[type='checkbox']").map(function () {

        if (this.checked == 1) {
            return '"' + this.name + '"';

        }


    }).get().join(",");


    gorevler = '"gorevler":[' + str1 + ']';
    var filter = "{" + subeler + gorevler + "}";
    console.log(filter);
    var text = $('#filtre');
    text.val(filter);

});

$('.gorevuser2').click(function () {


    var str1 = $("#gorevler input[type='checkbox']").map(function () {

        if (this.checked == 1) {
            return '"' + this.name + '"';

        }


    }).get().join(",");


    gorevler = '"gorevler":[' + str1 + ']';
    var filter = "{" + subeler2 + gorevler + "}";
    console.log(filter);
    var text = $('#filtre');
    text.val(filter);

});

$('.teskilat').click(function () {

    $(".subegorev").show();


});

function kampanya() {


    var bilgi = {

        filt: $("#filtre").val(), user: $("#user").val(),


    }
    $.ajax({
        type: 'POST', url: 'api/sms/APIKampanyaCreate.php', data: {query: bilgi}, success: function (msg) {
            console.log(msg);
            location.href = "?page=sms/gonder&kampanya=" + msg;
        }, error: function (msg) {
            alert(msg);
            console.log(msg);
        }
    });
}

