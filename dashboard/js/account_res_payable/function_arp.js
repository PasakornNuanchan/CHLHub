const function_arp = {
    select_all : async function(e){
        e == 'select' ? $('.table_data_account tbody > tr > td > .cbx_select').prop('checked',true) : $('.table_data_account tbody > tr > td > .cbx_select').prop('checked',false);
    },

    open_excel : async function(){
        window.location.href = '../dashboard/php/account_res_payable/gen_excel_file.php';
    },
}