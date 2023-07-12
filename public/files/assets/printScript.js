$(document).ready(loadDataTable());

function loadDataTable(){
    var table = $('#dataTable1').DataTable({
    responsive: false,
    scrollX: false,
    dom: '<"row py-md-3"<"col-md-6 col-sm-12"l><"col-md-6 col-sm-12"f>>Brtip',
    
    buttons: [ 
                {  
                    extend: 'excel',  
                    className: 'btn btn-success btn-sm mb-3',  
                    text: '<i class="far fa-file-excel"></i>Excel',
                    exportOptions: {
                        columns: ':not(last-child)'
                    },
                    attr: {id: 'excelBtn'} 
                },     

                {  
                    extend: 'print',
                    className: 'btn btn-warning btn-sm mb-3',  
                    text: '<i class="fa fa-print"></i> Print',
                    exportOptions: {
                        stripHtml: false,
                        columns: ':not(last-child)'
                    },
                    title: document.getElementById('tableTitle').innerHTML,
                    attr: {id: 'printBtn'},
                    customize: function ( win ) {
                        $
                        $(win.document.body)
                            .css( 'font-size', '12pt' )
                            .prepend(
                                '<img src="https://lh3.googleusercontent.com/pw/AIL4fc8Rd5kzgb2AKiT9owXkoOhEbmyT7EIqK1GzGP_mUU62G0PHOTUYjZsPKfkX1sQtbziuhUIJAEWGeRkIx6EIkffZHTrT9dTBvnrLbRbEX-ic7o4z1uly=w2400" class="mx-auto d-block" width="500px" id="pakar-logo">'
                            );
     
                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                        
                        $(win.document.body).find( 'h1' )
                        .addClass( 'text-center mb-3' )
                        .css( 'font-size', '42' );
                    }
                },

                {
                extend: 'colvis',
                className: 'btn btn-info btn-sm mb-3',
                text: 'Filter',
                attr: {id: 'colVisBtn'} 
                }
            ]
    });
    table.buttons().container().appendTo('#dataTable1 .row.col-md-6:eq(0)')
}

function hideLogo() {
var kkmLogo = document.getElementById("kkm-logo");
var pakarLogo = document.getElementById("pakar-logo");
var content = document.getElementById("content");
var tableTitle = document.getElementById("tableTitle");

kkmLogo.hidden = true;
pakarLogo.hidden = true;
content.classList.remove("ml-0");
tableTitle.hidden = true;

$(document).ready(loadDataTable());
}