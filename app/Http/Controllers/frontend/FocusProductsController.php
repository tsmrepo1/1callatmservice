<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPage;
use Illuminate\Http\Request;

class FocusProductsController extends Controller
{
    //LOAD FOCUS PRODUCT PAGE
    public function products(){
        $product = Product::where('status', 1)->paginate(6);
        $product_cat = [];
        
        $cats = ProductCategory::where(['parent_id' => 0, 'status' => 1])->get();
        
        foreach($cats as $cat) {
            $cat->subcats = ProductCategory::where(['parent_id' => $cat->id, 'status' => 1])->get();
            $product_cat[] = $cat;
        }
        
        $product_page = ProductPage::where('id', 1)->first();
        $selecdCatId = 0;
        $category= "<h2>ATM Machine Parts: Improved Performance and Security in Transactions</h2>
<p>ATMs have revolutionized the banking industry by offering unparalleled convenience and flexibility in financial services. These advanced machines have various features that work smoothly for easy withdrawal of cash, deposits, and other banking transactions. Essential to ATMs are the ATM cassettes and ATM cash dispensers, which ensure proper operation and safety.</p> 


<h2>ATM Cassette: The Backbone of Money Management</h2>
<p>ATM cassettes are an integral part of storing and dispensing cash. They act as a safe deposit box inside the ATM where the bills that customers withdraw during transactions reside. These cassettes come in different sizes for different currencies, allowing flexibility in currency consumption. Made of durable materials and equipped with security features, the ATM cassette machine ensures the safety of the cash inside the machine.</p>
<p>The cassette's design focuses on the ease with which authorized employees can refill ATMs while maintaining strict security measures to prevent unauthorized access. The rugged design protects against tampering and theft, including advanced locking mechanisms and concealment technology to protect deposits. Some cassettes have sensors and detectors for detecting fraudulent activities, enhancing the overall security of the ATM system.</p> 
 
<h2>ATM Cash Dispenser: Enables Simple Transactions</h2>
<p>The ATM cash dispenser is the feature that ensures users are given cash during withdrawals. It works with ATM cassettes and dispenses requested bills for accuracy and efficiency. Equipped with sophisticated systems, it ensures accurate counting and distribution of cash, reducing errors and discrepancies in transactions.</p> 
<p>This system uses highly accurate sensors and technology to identify complex currencies and manage them effectively. To enhance user experience and reliability, modern ATM cash dispensers boast advanced features such as anti-jam technology and real-time monitoring systems. These methods reduce the chances of technical errors and ensure a smooth disbursement process.</p> 
<p>Additionally, ATM cash dispensers undergo rigorous testing and quality assurance procedures to maintain optimum performance under environmental conditions. This includes resistance to heat fluctuations, temperature, and physiological pressure, ensuring consistent operation regardless of the ATM location or frequency. 
</p>

<h2>Understanding the Other ATM Machine Parts</h2>
<p>Here's an overview of the other key ATM Machine Parts: </p> 

<h3>Card Reader </h3>
<p>The card reader reads and authenticates the 
inserted cards using magnetic stripe or EMV chip technology. It verifies the card information before transactions. 
</p>

<h2>Keypad</h2>
<p>The keypad enables users to input their Personal Identification Number (PIN) securely. It's designed with encryption to protect PINs from potential theft. 
</p>

<h2>Display Screen</h2>
<p>ATM screens display transaction options, instructions, and other relevant information to users. Some even have touch interfaces for navigation. 
</p>

<h2>Receipt Printer</h2>
<p>
After transactions, the ATM generates a receipt detailing the transaction type, date, time, and remaining balance. The receipt printer produces these records for user reference. 
</p>

<h2>Conclusion</h2>
<p>
In summary, ATMs, cash registers, and cash dispensers play an integral role in the efficient and secure operation of cash machines. These features are optimized to protect funds, provide seamless transactions, and maintain the integrity of the banking system. 
</p>
<p>
Their robust architecture, advanced security features, and precision mechanisms ensure that cash in ATMs is safe and provides a user-friendly experience. As technology advances, these factors evolve to further enhance the reliability, security, and stability of internal ATM transactions.
</p>";
        return view('frontend.products',compact('product', 'product_cat', 'product_page', 'selecdCatId','category'));
    }

    // LOAD PRODUCT DETAILS
    public function product_details(Request $req)
    {
        $slug = $req->slug;
        $product = Product::where('status', 1)->where('slug', $slug)->first();
        $more_product = Product::where('status', 1)->get();
        $related_products = Product::where('status', 1)->take(4)->inRandomOrder()->get();
        return view('frontend.product-details', compact('product', 'more_product', 'related_products'));
    }

    public function product_cat($slug)
    {
       
        $product = Product::leftjoin('product_categories', 'product_categories.id', '=', 'products.cat_id')->select('products.*')->where('product_categories.slug', $slug)->paginate(6);
        $product_cat = [];
        
        $cats = ProductCategory::where(['parent_id' => 0, 'status' => 1])->get();
        
        foreach($cats as $cat) {
            $cat->subcats = ProductCategory::where(['parent_id' => $cat->id, 'status' => 1])->get();
            $product_cat[] = $cat;
        }
        
        $product_page = ProductCategory::where('slug', $slug)->select('meta_title','meta_description as meta_desc','meta_keyword')->first();
        
        

        $selecdCatId = 0;
        if($slug) {
           $genid = ProductCategory::where('slug', $slug)->first();
            
            $selecdCatId = $genid->id;
            $category = $genid->description;
        }
        else {
            $selecdCatId = 0;
            $category = "";
        }

        //dd($product);// dd($selecdCatId);
        return view('frontend.products', compact('product', 'product_cat', 'product_page', 'selecdCatId','category'));
    }
}
