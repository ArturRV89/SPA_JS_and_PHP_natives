<script>

</script>
<form method="post">
    <div class="mb-3">
        <input name="sum" type="text" class="form-control" id="inputSum" placeholder="Sum">
    </div>
    <div class="mb-3">
        <select name="type" id="inputType" class="form-select">
            <option selected disabled>Select type</option>
            <option value="Coming">Coming</option>
            <option value="Expenditure">Expenditure</option>
        </select>
    </div>
    <div class="mb-3">
        <textarea name="comment" class="form-control" id="inputComment" rows="3" placeholder="Comment"></textarea>
    </div>
    <div>
        <button type="button" class="add_rec btn btn-success">Add</button>
    </div>
</form>

<div id="total" class="mt-4" style="border: solid 2px; padding: 10px 20px;">
    <div id="total_coming"></div>
    <div id="total_expenditure"></div>
</div>

<table class="table mt-3" id="table_rec">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Sum</th>
        <th scope="col">Type</th>
        <th scope="col">Comment</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script src="../js/general.js"></script>