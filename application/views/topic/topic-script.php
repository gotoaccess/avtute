<script type="text/javascript">
  $(document).ready(function(){
    var listUrl = '<?php echo base_url("topic/list?key=all") ?>';
    var $table = $('#menu-list').DataTable({
      "searching": false,
      "processing": true,
      "serverSide": true,
      "deferRender": true,
      "language": {
        "processing": '<img width="24" height="24" src="<?php echo base_url('optimum/loading.svg') ?>" />',
        "emptyTable": "No Menu available ...",
      },
      "order": [],
      "ajax": {
        url: listUrl,
        type: "GET",
      },

      "pageLength": 10
    });

    $('select[name="menu_parent"]').select2({
      ajax: {
          url: '<?php echo base_url('menu') ?>',
          type: "GET",
          dataType: 'json',
          data: function (params) {
            var query = {
              search: params.term,
              index: 'parent'
            }
            return query;
          },
          processResults: function(data) {
            return {
              results: data
            };
          },
      }
    });

    $('form#topic-add').on('submit', function(event){
      event.preventDefault();
      var thisForm = $(this);
      var $formData = $(this).serialize();
      $.ajax({
          url: '<?php echo base_url('topic/submit'); ?>',
          type: 'get',
          dataType: 'json',
          data: $formData,
          beforeSend: function(){
            thisForm.append('<img width="50" src="<?php echo base_url("optimum/greay-loading.svg") ?>"/>');
          },
          success: function(data) {
            if (!data.error) {
              Swal.fire({
                title: data.msg,
                html: "Error Information " + data.error,
                type: 'success',
                showCancelButton: true,
              }).then((result) => {
                if (result.value) {
                  $table.ajax.url(listUrl).load();
                  thisForm.trigger("reset");
                } else {
                  console.log(result);
                }
              });
            }else{
              Swal.fire({
                title: data.msg,
                html: "Error Information " + data.error,
                type: 'error',
                showCancelButton: true,
              })
            }

          },
        })
    });
  });
</script>
