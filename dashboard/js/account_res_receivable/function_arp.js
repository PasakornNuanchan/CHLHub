const function_arp = {
    select_all : async function(e){
        e == 'select' ? $('.table_data_account tbody > tr > td > .cbx_select').prop('checked',true) : $('.table_data_account tbody > tr > td > .cbx_select').prop('checked',false);
    },
}