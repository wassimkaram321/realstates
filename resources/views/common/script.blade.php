 <!-- jQuery -->
    <script src="{{asset('dashboard/assets/vendor/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <!-- Bootstrap -->
    <script src="{{asset('dashboard/assets/vendor/popper.js')}}"></script>
    <script src="{{asset('dashboard/assets/vendor/bootstrap.min.js')}}"></script>

    <!-- Simplebar -->
    <!-- Used for adding a custom scrollbar to the drawer -->
    <script src="{{asset('dashboard/assets/vendor/simplebar.js')}}"></script>


    <!-- Vendor -->
    <script src="{{asset('dashboard/assets/vendor/Chart.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/vendor/moment.min.js')}}"></script>

    <!-- APP -->
    <script src="{{asset('dashboard/assets/js/color_variables.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/app.js')}}"></script>


    <script src="{{asset('dashboard/assets/vendor/dom-factory.js')}}"></script>
    <!-- DOM Factory -->
    <script src="{{asset('dashboard/assets/vendor/material-design-kit.js')}}"></script>
    <!-- MDK -->
    

    <script>
        (function() {
            'use strict';
            // Self Initialize DOM Factory Components
            domFactory.handler.autoInit()


            // Connect button(s) to drawer(s)
            var sidebarToggle = document.querySelectorAll('[data-toggle="sidebar"]')

            sidebarToggle.forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    var selector = e.currentTarget.getAttribute('data-target') || '#default-drawer'
                    var drawer = document.querySelector(selector)
                    if (drawer) {
                        if (selector == '#default-drawer') {
                            $('.container-fluid').toggleClass('container--max');
                        }
                        drawer.mdkDrawer.toggle();
                    }
                })
            })
        })()
    </script>


    <script src="{{asset('dashboard/assets/vendor/jquery.dataTables.js')}}"></script>
    <script src="{{asset('dashboard/assets/vendor/dataTables.bootstrap4.js')}}"></script>

    <script>
        $('#data-table').dataTable();
    </script>
    <script src="assets/vendor/summernote-bs4.min.js"></script>
    
    <script type="text/javascript">
    $(function () {
        $("#myTable").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print',
            ],
            "order": []
    });
    });
</script>
 <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
 <script type="text/javascript"  src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
 <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>-->
 <!--    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>-->
 <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.0/sweetalert2.min.js" integrity="sha512-IYzd4A07K9kxY3b8YIXi8L0BmUPVvPlI+YpLOzKrIKA3sQ4gt43dYp+y6ip7C7LRLXYfMHikpxeprZh7dYQn+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->

     <script>

     

         $('.delete-confirm').on('click', function(event) {
             event.preventDefault();
             const url = $(this).attr('href');




                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                })
         });
     </script>
<!--     <script>-->
<!--         $(document).ready(function () {-->
<!--    $('#example').DataTable({-->
<!--        initComplete: function () {-->
<!--            this.api()-->
<!--                .columns()-->
<!--                .every(function () {-->
<!--                    var column = this;-->
<!--                    var select = $('<select><option value=""></option></select>')-->
<!--                        .appendTo($(column.footer()).empty())-->
<!--                        .on('change', function () {-->
<!--                            var val = $.fn.dataTable.util.escapeRegex($(this).val());-->
 
<!--                            column.search(val ? '^' + val + '$' : '', true, false).draw();-->
<!--                        });-->
 
<!--                    column-->
<!--                        .data()-->
<!--                        .unique()-->
<!--                        .sort()-->
<!--                        .each(function (d, j) {-->
<!--                            select.append('<option value="' + d + '">' + d + '</option>');-->
<!--                        });-->
<!--                });-->
<!--        },-->
<!--    });-->
<!--});-->
<!--     </script>-->

  
<script>
    function showDeleteConfirmation(id, route) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'DELETE',
                    url: route,
                    data: {
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                        location.reload();
                    }
                });
            }
        });
    }
</script>