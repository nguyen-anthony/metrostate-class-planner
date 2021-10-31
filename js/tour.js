$(function () {
    var majors = []
    var goals = [
        ['goalOneTable', 1],
        ['goalThreeTable', 7],
        ['goalFourTable', 9],
        ['goalFiveTable', 10],
        ['goalSixTable', 12],
        ['goalSevenTable', 13],
        ['goalEightTable', 14],
        ['goalNineTable', 15],
        ['goalTenTable', 16],
        ['rigrTable', 19],
        ['liberalStudiesTable', 18]
    ];

    $.each(goals, function (index, value) {
        $.get('majors.php?data=goals&goal_id=' + value[1]).done(function (data) {
            $('#' + value[0]).append(data);
        });
    });

    $.get('majors.php?data=raw').done(function (data) {
        majors = data.split(',');
    });

    $.get('majors.php?data=clean').done(function (data) {
        $('#majorDropdown').append(data);
    });

    $.get('advisors.php?data=clean').done(function (data) {
        $('#studentDropdown').append(data);
    })

    $('#studentDropdown').on('change', function (e) {
        $('#majorCoursesTable .table-data').remove();
        $.get('majors.php?data=majorStudent&student_id=' + $('#studentDropdown').val()).done(function (data) {
            setTimeout(function () {
                $('#majorCoursesTable').append(data);;
            }, 1000);
        });
    });

    $('#majorSearchSubmit').on('click', function (e) {
        if ($('#majorSearch').val() !== '') {
            var text = $('#majorSearch').val();
            var searchReg = new RegExp(text, 'ig');
            $.each(majors, function (index, value) {
                if (value.match(searchReg)) {
                    var cleanString = value.trim();
                    var stringExplode = cleanString.split(' ');
                    var id = stringExplode.join('-');
                    id = id.toLowerCase();
                    $('#majorDropdown option[id="' + id + '"]').prop('selected', true);
                    $('#majorDropdown').change();
                }
            });
        }
    });

    $('#clearSearch').on('click', function (e) {
        $('#majorSearch').val(' ');
    });

    $('#majorDropdown').on('change', function (e) {
        $('#majorCoursesTable .table-data').remove();
        $.get('majors.php?data=major&major_id=' + $('#majorDropdown').val()).done(function (data) {
            $('#majorCoursesTable').append(data);
        });
    });

    $(document).on('click', '.completeButton', function (e) {
        $('button').attr('disabled', true);
        let value = $(this).val();
        let status = '';
        console.log($('.row-' + value).hasClass('completed'));
        if ($('.row-' + value).hasClass('completed')) {
            status = 'remove';
        } else {
            status = 'add';
        }

        $.get('majors.php?data=complete&course_id=' + $(this).val() + '&status=' + status).done(function (data) {
            console.log(data);
            if (data === 'success') {
                if ($('.row-' + value).hasClass('completed')) {
                    $('.row-' + value).removeClass('completed');
                } else {
                    $('.row-' + value).addClass('completed');
                }
                $('.button-' + value);
            }

            $('button').attr('disabled', false);
        });
        e.stopPropagation();
        e.stopImmediatePropagation();
    });

    setTimeout(function () {
        $('#majorDropdown').change();
    }, 500);
});