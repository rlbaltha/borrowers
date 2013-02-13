comment = "Borrowers and Lenders";
a1 = new Image(150,58);
a1.src = "/bundles/borrowershome/img/current_issue_off.jpg";
a2 = new Image(150,58);
a2.src = "/bundles/borrowershome/img/current_issue_on.jpg";

b1 = new Image(150,54);
b1.src = "/bundles/borrowershome/img/previous_issue_off.jpg";
b2 = new Image(150,54);
b2.src = "/bundles/borrowershome/img/previous_issue_on.jpg";

c1 = new Image(150,36);
c1.src = "/bundles/borrowershome/img/archive-off.jpg";
c2 = new Image(150,36);
c2.src = "/bundles/borrowershome/img/archive-on.jpg";

d1 = new Image(150,36);
d1.src = "/bundles/borrowershome/img/b4-off-book-d2.jpg";
d2 = new Image(150,36);
d2.src = "/bundles/borrowershome/img/b4-on-book-d2.jpg";

e1 = new Image(150,36);
e1.src = "/bundles/borrowershome/img/b5-off-book-d2.jpg";
e2 = new Image(150,36);
e2.src = "/bundles/borrowershome/img/b5-on-book-d2.jpg";

f1 = new Image(150,36);
f1.src = "/bundles/borrowershome/img/b6-off-book-d2.jpg";
f2 = new Image(150,36);
f2.src = "/bundles/borrowershome/img/b6-on-book-d2.jpg";

//image swapping function:
function imageSwap(imgDocID, imgObjName, comment) {
document.images[imgDocID].src = eval(imgObjName + ".src");
window.status = comment; return true;
}

