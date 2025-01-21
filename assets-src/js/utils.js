const escapeHTML = function (value) {
    const lt = /</g, 
    gt = />/g, 
    ap = /'/g, 
    ic = /"/g;
    return value.toString().replace(lt, "&lt;").replace(gt, "&gt;").replace(ap, "&#39;").replace(ic, "&#34;");
}