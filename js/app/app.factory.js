app.service('PluginFactory', PluginFactory)

function PluginFactory($window) {

    // ***************** Datatable      ***********************
    $.extend(true, $.fn.dataTable.defaults, {
        "language": {
            "sProcessing": "กำลังดำเนินการ...",
            "sLengthMenu": "แสดง_MENU_ แถว",
            "sZeroRecords": "ไม่พบข้อมูล",
            "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
            "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
            "sInfoPostFix": "",
            "sSearch": "ค้นหา:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "เริ่มต้น",
                "sPrevious": "ก่อนหน้า",
                "sNext": "ถัดไป",
                "sLast": "สุดท้าย"
            }
        }
    });
    // ***************** Datatable      ***********************

    //http://tympanus.net/Development/GammaGallery/
    //http://tympanus.net/codrops/2012/11/06/gamma-gallery-a-responsive-image-gallery-experiment/
    var GammaSettings = {
        // order is important!
        viewport: [{
                width: 1200,
                columns: 6
            }, {
                width: 900,
                columns: 5
            }, {
                width: 500,
                columns: 3
            }, {
                width: 320,
                columns: 2
            }, {
                width: 0,
                columns: 2
            }],
    };
    function singleUpload() {

        $('#idBtnPicture').on('click', function () {
            $('#idInputPicture').on('change', function () {
                var input = this;
                if (input.files && input.files[0]) {
                    console.log(' image size ::==', input.files[0].size);
                    if (input.files[0].size > FILE_SIZE_KB) {
                        $window.alert('ไม่อนุญาติไฟล์ขนาดเกิน ' + FILE_SIZE_MB + ' MB');
                        $('#idInputPicture').val('');
                        return false;
                    }
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#idImgPicture').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }).trigger('click');
        });
    }

    function mutiUpload(imageList) {
        angular.forEach(imageList, function (img, ind) {
            if (img.size > FILE_SIZE_KB) {
                $window.alert('ไม่อนุญาติไฟล์ขนาดเกิน ' + FILE_SIZE_MB + ' MB');
                $('#socialInput').val('');
                return false;
            }
            var reader = new FileReader();
            reader.onload = function (e) {
                console.log('xxxx');
                $('#image' + ind).attr('src', e.target.result);
            }
            reader.readAsDataURL(img);
        });
    }

    return {
        initJqueryPlugin: function () {

            //http://www.zerotheme.com/1756/zredbiker-free-responsive-html5-template.html
            $('.maps').click(function () {
                $('.maps iframe').css("pointer-events", "auto");
            });
            $(".maps").mouseleave(function () {
                $('.maps iframe').css("pointer-events", "none");
            });
            (function () {
                $("#slider").responsiveSlides({
                    auto: true,
                    pager: false,
                    nav: true,
                    speed: 500,
                    namespace: "callbacks",
                    before: function () {
                        $('.events').append("<li>before event fired.</li>");
                    },
                    after: function () {
                        $('.events').append("<li>after event fired.</li>");
                    }
                });
                $('.table.celled.striped').DataTable();
                $('.special.cards .image').dimmer({on: 'hover'});
                $('.ui.dropdown').dropdown({placeholder: false});
                $('.action-set').click(function () {
                    $(this).closest('.segment').find('.ui.dropdown').dropdown('set selected', $(this).data('set'));
                });
                $('.action-clear').click(function () {
                    $(this).closest('.segment').find('.ui.dropdown').dropdown('clear');
                });
                $('.ui.rating').rating();
                $('#DataTables_Table_0_filter').find('label').addClass('ui').addClass('form').addClass('mini');
                $('#DataTables_Table_0_length').find('label').addClass('ui').addClass('form').addClass('mini');
                $('.ui.embed').embed();
                Gamma.init(GammaSettings, function () {

                });
            }());
        },
        compomentUpload: singleUpload,
        componentMutiUpload: mutiUpload,
        componentDropzone: function () {
            // "myAwesomeDropzone" is the camelized version of the HTML element's ID
            $timeout(function () {
                var myDropzone = {};
                Dropzone.options.myDropzone = {
                    paramName: "file", // The name that will be used to transfer the file
                    maxFilesize: 2, // MB
                    autoProcessQueue: false,
                    uploadMultiple: true,
                    parallelUploads: 10,
                    maxFiles: 10,
                    addRemoveLinks: true,
                    dictRemoveFile: "<button class=\"ui button mini red\">ลบ</button>",
                    dictDefaultMessage: 'ลากรูปมาวางที่นี่',
                    dictResponseError: 'เกิดข้อผิดพลาด',
                    //acceptedFiles: 'image/*',
                    init: function () {
                        myDropzone = this;
                        var self = this;
                        myDropzone.options.autoProcessQueue = false;
                        self.on("sending", function (file, xhr, formData) {
                            // Will send the filesize along with the file as POST data.
                            formData.append("title", vm.title);
                            formData.append("status", vm.status);
                            formData.append("desc", vm.desc);
                        });
                        //New file added
                        self.on("addedfile", function (file) {
                            console.log('new file added ', file);
                        });
                        // Send file starts
                        self.on("sending", function (file) {
                            console.log('upload started', file);
                        });
                        // File upload Progress
                        self.on("totaluploadprogress", function (progress) {
                            console.log("progress ", progress);
                            $('.roller').width(progress + '%');
                        });
                        self.on("queuecomplete", function (progress) {

                        });
                        // On removing file
                        self.on("removedfile", function (file) {
                            console.log(file);
                        });
                    },
                    accept: function (file, done) {
                        file.acceptDimensions = done;
                        file.rejectDimensions = function () {
                            done('The image must be at least 1024 by 768 pixels in size');
                        };
                    },
                };
                vm.uploadGallery = function () {
                    console.log('xxxxx');
                    if (!myDropzone.options.autoProcessQueue) {
                        myDropzone.processQueue();
                    }
                }
            }, 1000);
        }
    }
}
