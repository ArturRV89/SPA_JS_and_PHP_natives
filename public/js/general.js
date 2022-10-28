$(document).ready(showAllRecords());

function showAllRecords() {
    fetch('../query/allRec.php')
        .then((response) => response.json())
        .then((data) => {
            let tBody = document.getElementsByTagName('tbody')[0];
            data.forEach((record) => {
                let newLine = document.createElement('tr');

                let tdId = document.createElement('td');
                tdId.append(record['id']);
                newLine.appendChild(tdId);

                let tdSum = document.createElement('td');
                tdSum.append(record['sum']);
                newLine.appendChild(tdSum);

                let tdType = document.createElement('td');
                tdType.append(record['type']);
                newLine.appendChild(tdType);

                let tdComment = document.createElement('td');
                tdComment.append(record['comment']);
                newLine.appendChild(tdComment);

                let tdDelete = document.createElement('td');
                let buttonDelete = document.createElement('button');
                buttonDelete.innerHTML = "delete";
                buttonDelete.setAttribute("class", "delete_rec btn btn-danger");

                let id = record['id'];
                buttonDelete.addEventListener("click", function (e) {
                    e.stopPropagation();
                    e.preventDefault();
                    $.ajax({
                        method: 'post',
                        url: '../query/deleteRec.php',
                        data: {'id': id},
                        cache: false,
                        success: (function () {
                            let body = document.getElementsByTagName('tbody')[0];
                            body.replaceChildren();

                            $('#total_coming').val('');
                            $('#total_expenditure').val('');
                            sum_all_type();

                            showAllRecords();
                        })
                    })
                });

                tdDelete.appendChild(buttonDelete);

                newLine.appendChild(tdDelete);

                tBody.appendChild(newLine);
                sum_all_type();
            });
        });
}

$(document).ready(function () {
    $('button.add_rec').on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        let sum = $('#inputSum').val();
        let type = $('#inputType').val();
        let comment = $('#inputComment').val();

        $.ajax({
            method: 'post',
            url: '../query/addRec.php',
            data: {
                sum: sum,
                type: type,
                comment: comment
            },
            success: (function () {
                $('#inputSum').val('');
                $('#inputType').val('');
                $('#inputComment').val('');
                let body = document.getElementsByTagName('tbody')[0];
                body.replaceChildren();

                showAllRecords();
                $('#total_coming').val('');
                $('#total_expenditure').val('');
                sum_all_type();
            })
        })
    });
});

function sum_all_type() {
    $(document).ready(function () {
        fetch('../query/total.php')
            .then((response) => response.json())
            .then((data) => {
                let coming_sum = (data[0]['coming_sum']);
                let expenditure_sum = (data[1]['expenditure_sum']);

                total_coming.innerText = 'Total coming : ' + coming_sum;
                total_expenditure.innerText = 'Total expenditure : ' + expenditure_sum;
            });
    });
}




