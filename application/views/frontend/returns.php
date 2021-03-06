<?php
include "template/header.php";
?>
<div class="banner">
</div>
<div class="container_row">
    <!-- search box -->
    <div class="f_search_top_box_div f_t_search">
        <input type="text" class="f_shop_s_ipt" placeholder="Search" value="<?php if(isset($name)) echo $name;?>" />
        <img src="<?php echo base_url();?>assets/frontend/lib/img/icons/search.png" class="f_shop_s_btn" />
        <a href="<?php echo base_url();?>front/shop_bycategories" class="g_btn_b">shop by categories</a>
        <a href="<?php echo base_url();?>front/shop_byadvanced" class="g_btn_b">advanced part finder</a>
    </div>
    <div class="f_t_tlt">Warranty & Returns</div>
    <div class="f_abt_cnt_dv">
        <div class="f_t_cnt">
            At Dave’s Starter & Alternator , we strive to achieve 100% customer satisfaction.
            If you are experiencing any issues with any of our products, contact our Warranty and Returns department using the information below.
        </div>
        <div class="f_s_tlt">Returns & Warranty-Replacements </div>
        <div class="f_t_cnt">
            Unless otherwise specified in the item listing on our website, on the receipt or packing slip, or in the following terms, Dave’s Starter & Alternator will accept qualified and conforming products for replacement for the period of 1 (one) year. An order may be refunded only within 14 days of the original purchase date. All shipping charges are non-refundable.

            All returned products will be thoroughly inspected and a determination will be made if eligibility and conforming requirements are met. Products must be in ‘Like New’ condition and free from damage of any type, including, but not limited to dents, scratches, cracks, abuse, defacement or indication of removed screws/fasteners or seals.

            In the event that the product you are returning does NOT meet the requirements described in this document, we will:
            1) Photograph the merchandise and packaging, and prepare a detailed summary of our determination as to why the return was denied
            2) The product(s) deemed ineligible for return will be returned to you.

            If Dave’s Starter & Alternator, at our sole discretion, decides to accept a non-qualified item for return, a restocking fee of up to 25% will be assessed.

            Return processing may take up to 5 business days from the time your product is received by Dave’s Starter & Alternator.
        </div>
        <div class="f_s_tlt">When returning an item, the following will apply</div>
        <div class="f_t_cnt">
            All shipping fees on orders outside of the 48 continental
            United States are the responsibility of the customer.

            Dave’s Starter & Alternator shall not be held liable for packages lost in transit.

            If an immediate replacement is required before processing
            can occur, the customer can purchase a second unit from Dave’s Starter &
            Alternator to be shipped to the customer at once.  After Dave’s Starter &
            Alternator receives the returned unit, Dave’s Starter & Alternator  will issue a
            refund for the second purchase. Send Email with your name, invoice number, and details
            about the return to: returns@***** or call 877-644-3721 Ask for our returns department.
        </div>
        <div class="f_s_tlt">Custom Made Items Refunds </div>
        <div class="f_t_cnt">
            Custom made items such as powder coated and high output units cannot be
            refunded unless unit is returned within 14 days of purchase and is in ‘Like New’
            condition and free from damage of any type, including, but not limited to dents,
            scratches, cracks, abuse, defacement or indication of removed screws/fasteners or seals.
            All custom made items are subject to a 25% restocking fee regardless of condition of unit.
            All shipping charges are non-refundable. If a returned unit is received by Dave’s Starter &
            Alternator  and the unit is not deemed 'Like New’, Dave’s Starter & Alternator will offer to
            repair the unit and ship the unit back to the customer at said customer's expense. For your protection,
            we recommend that you insure your return and use a traceable carrier that can provide you with delivery
            confirmation.
        </div>
        <div class="f_s_tlt">Custom Made Items Warranty-Replacement </div>
        <div class="f_t_cnt">
            When sending a return to Dave’s Starter & Alternator or repair or replacement,
            send the item to Dave’s Starter & Alternator with a description of what is wrong
            with the item and Dave’s Starter & Alternator will repair or replace the item.
            For your protection, we recommend that you insure your return and use a traceable
            carrier that can provide you with delivery confirmation. Dave’s Starter & Alternator will
            not be responsible for items returned that are lost or damaged in transit. Postage and handling
            charges, both to and from our warehouse will be paid by the customer, and are non-refundable.
            At our discretion, Dave’s Starter & Alternator may reimburse shipping charges related to the return
            or replacement of defective products inside the U.S. only.
        </div>
        <div class="f_s_tlt">Labor Fees  </div>
        <div class="f_t_cnt">
            Labor fees are not covered under our warranty program.
        </div>
        <div class="f_s_tlt">Warranty</div>
        <div class="f_t_cnt">
            All of our products are covered by our  one year warranty from date of purchase.
            If you have a problem, we will take every step to assist you.

        </div>
        <div class="f_s_tlt">To Contact Us About Your Return </div>
        <div class="f_t_cnt">
            Send Email with your name, invoice number, and details about the return to:
            returns@******** We will answer your email as soon as possible, usually the
            same day. Or you may call (877-644-3721) and talk to a returns specialist.
            Our returns department is open for calls Monday through Friday 8:00am-5:00pm
            Eastern Time. On heavy volume call days please leave a voice mail message and
            you will receive a call-back or email as soon as possible.
        </div>
    </div>
</div>
<?php
include "template/footer.php";
?>
