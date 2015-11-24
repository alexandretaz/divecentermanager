var Product = {
    updateStockItens:function(receivedData) {
        data = {id:parseInt($(receivedData).find("input[name='id']")['0'].value,10),
        qtyStock:parseInt($(receivedData).find('input[name="qtyStock"]')['0'].value,10)
        };
        $.post("/stock/api/variation/update/qty", data);   
        
        
   },
    onClickVariationTd:function( obj ) {
        if (typeof obj === 'undefined') {
            obj = this;
        }
        $(obj).find(".formVariationStock").toggleClass("hiddenElement");
        $(obj).find(".infoVariationStock").toggleClass("hiddenElement");
   },
}
