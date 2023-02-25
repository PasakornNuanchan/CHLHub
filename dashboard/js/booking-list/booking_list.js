const booking_list = {
    preview : function (job_number) {
        window.location = 'CHL-booking.php' + '?job_number=' + job_number+'&action=preview';
    },
    modal_quotation : function () {  
        let html_modal = `        
            <!-- Modal -->
            <div class="modal fade" id="modal_quotation_select" tabindex="-1" aria-labelledby="modal_quotation_selectLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_quotation_selectLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
            </div>
        `;
        $('body').append(html_modal);

        $('#modal_quotation_select').modal('show');
    },
}