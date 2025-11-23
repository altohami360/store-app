<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => [
                    'en' => 'Shipping Information',
                    'ar' => 'معلومات الشحن',
                ],
                'slug' => 'shipping-information',
                'content' => [
                    'en' => "Shipping Policy

We offer reliable and fast shipping services to ensure your orders reach you safely and on time.

Shipping Methods:
• Standard Shipping (3-7 business days): Free for orders over 100 SAR
• Express Shipping (1-2 business days): 25 SAR
• Same Day Delivery (for selected cities): 35 SAR

Shipping Areas:
We currently ship to all cities within Saudi Arabia. International shipping is not available at this time.

Order Processing Time:
Orders are typically processed within 1-2 business days. You will receive a tracking number via email once your order has been shipped.

Tracking Your Order:
You can track your order using the tracking number provided in your shipping confirmation email. Simply visit the courier's website and enter your tracking number.

Shipping Costs:
Shipping costs are calculated based on the weight of your order and your delivery location. You can view the shipping cost during checkout before completing your purchase.

Note: Orders placed on weekends or public holidays will be processed on the next business day.",
                    'ar' => "سياسة الشحن

نحن نقدم خدمات شحن موثوقة وسريعة لضمان وصول طلباتك إليك بأمان وفي الوقت المحدد.

طرق الشحن:
• الشحن القياسي (3-7 أيام عمل): مجاني للطلبات التي تزيد عن 100 ريال سعودي
• الشحن السريع (1-2 يوم عمل): 25 ريال سعودي
• التوصيل في نفس اليوم (للمدن المختارة): 35 ريال سعودي

مناطق الشحن:
نقوم حاليًا بالشحن إلى جميع المدن داخل المملكة العربية السعودية. الشحن الدولي غير متاح في الوقت الحالي.

وقت معالجة الطلب:
عادة ما يتم معالجة الطلبات في غضون 1-2 يوم عمل. ستتلقى رقم تتبع عبر البريد الإلكتروني بمجرد شحن طلبك.

تتبع طلبك:
يمكنك تتبع طلبك باستخدام رقم التتبع المقدم في البريد الإلكتروني لتأكيد الشحن. ما عليك سوى زيارة موقع شركة الشحن وإدخال رقم التتبع الخاص بك.

تكاليف الشحن:
يتم حساب تكاليف الشحن بناءً على وزن طلبك وموقع التسليم الخاص بك. يمكنك عرض تكلفة الشحن أثناء عملية الدفع قبل إتمام عملية الشراء.

ملاحظة: سيتم معالجة الطلبات المقدمة في عطلات نهاية الأسبوع أو العطلات الرسمية في يوم العمل التالي.",
                ],
                'meta_description' => [
                    'en' => 'Learn about our shipping methods, delivery times, and shipping costs for orders within Saudi Arabia.',
                    'ar' => 'تعرف على طرق الشحن لدينا، أوقات التسليم، وتكاليف الشحن للطلبات داخل المملكة العربية السعودية.',
                ],
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Returns & Exchanges',
                    'ar' => 'الإرجاع والاستبدال',
                ],
                'slug' => 'returns-exchanges',
                'content' => [
                    'en' => "Returns & Exchanges Policy

We want you to be completely satisfied with your purchase. If for any reason you are not happy with your order, we offer a flexible return and exchange policy.

Return Period:
You have 30 days from the date of delivery to return an item for a full refund or exchange.

Return Conditions:
• Items must be unused and in their original packaging
• All tags and labels must be intact
• Items must include all original accessories and manuals
• Products must not show signs of wear or use

Return Process:
1. Contact our customer service team at support@example.com or call +966-XXX-XXXX
2. Provide your order number and reason for return
3. We will provide you with a return shipping label
4. Pack the item securely in its original packaging
5. Attach the return label and ship the item back to us

Refund Processing:
Once we receive your return, we will inspect the item and process your refund within 5-7 business days. Refunds will be issued to the original payment method.

Exchange Process:
If you would like to exchange an item for a different size or color, please contact our customer service team. We will arrange a free exchange for you.

Non-Returnable Items:
• Opened hygiene products (cosmetics, personal care items)
• Custom or personalized items
• Digital products or gift cards
• Sale or clearance items marked as final sale

Return Shipping Costs:
Return shipping is free for defective or incorrect items. For other returns, a flat return shipping fee of 15 SAR will be deducted from your refund.

Damaged or Defective Items:
If you receive a damaged or defective item, please contact us immediately with photos of the damage. We will arrange a replacement or full refund at no cost to you.",
                    'ar' => "سياسة الإرجاع والاستبدال

نريد أن تكون راضيًا تمامًا عن عملية الشراء الخاصة بك. إذا لم تكن سعيدًا بطلبك لأي سبب من الأسباب، فإننا نقدم سياسة إرجاع واستبدال مرنة.

فترة الإرجاع:
لديك 30 يومًا من تاريخ التسليم لإرجاع منتج للحصول على استرداد كامل أو استبدال.

شروط الإرجاع:
• يجب أن تكون المنتجات غير مستخدمة وفي عبوتها الأصلية
• يجب أن تكون جميع العلامات والملصقات سليمة
• يجب أن تتضمن المنتجات جميع الملحقات والأدلة الأصلية
• يجب ألا تظهر المنتجات علامات التآكل أو الاستخدام

عملية الإرجاع:
1. اتصل بفريق خدمة العملاء لدينا على support@example.com أو اتصل بـ +966-XXX-XXXX
2. قدم رقم طلبك وسبب الإرجاع
3. سنزودك بملصق شحن الإرجاع
4. قم بتعبئة المنتج بشكل آمن في عبوته الأصلية
5. أرفق ملصق الإرجاع وأرسل المنتج إلينا

معالجة الاسترداد:
بمجرد استلامنا لإرجاعك، سنقوم بفحص المنتج ومعالجة استردادك في غضون 5-7 أيام عمل. سيتم إصدار المبالغ المستردة إلى طريقة الدفع الأصلية.

عملية الاستبدال:
إذا كنت ترغب في استبدال منتج بحجم أو لون مختلف، يرجى الاتصال بفريق خدمة العملاء لدينا. سنقوم بترتيب استبدال مجاني لك.

المنتجات غير القابلة للإرجاع:
• منتجات النظافة المفتوحة (مستحضرات التجميل، منتجات العناية الشخصية)
• المنتجات المخصصة أو الشخصية
• المنتجات الرقمية أو بطاقات الهدايا
• منتجات التخفيض أو التصفية المحددة كبيع نهائي

تكاليف شحن الإرجاع:
شحن الإرجاع مجاني للمنتجات المعيبة أو غير الصحيحة. بالنسبة للإرجاعات الأخرى، سيتم خصم رسوم شحن إرجاع ثابتة قدرها 15 ريال سعودي من استردادك.

المنتجات التالفة أو المعيبة:
إذا تلقيت منتجًا تالفًا أو معيبًا، يرجى الاتصال بنا على الفور مع صور للضرر. سنقوم بترتيب استبدال أو استرداد كامل للمبلغ دون أي تكلفة إضافية.",
                ],
                'meta_description' => [
                    'en' => 'Our return and exchange policy allows you to return items within 30 days for a full refund or exchange.',
                    'ar' => 'تتيح لك سياسة الإرجاع والاستبدال لدينا إرجاع المنتجات في غضون 30 يومًا للحصول على استرداد كامل أو استبدال.',
                ],
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Privacy Policy',
                    'ar' => 'سياسة الخصوصية',
                ],
                'slug' => 'privacy-policy',
                'content' => [
                    'en' => "Privacy Policy

Last Updated: ".date('F d, Y')."

Your privacy is important to us. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or make a purchase.

Information We Collect:
• Personal Information: Name, email address, phone number, shipping address, and billing information
• Payment Information: Credit card details (processed securely through our payment gateway)
• Account Information: Username, password, and purchase history
• Technical Information: IP address, browser type, device information, and cookies

How We Use Your Information:
• To process and fulfill your orders
• To send order confirmations and shipping updates
• To respond to customer service inquiries
• To improve our website and services
• To send promotional emails (with your consent)
• To detect and prevent fraud

Information Sharing:
We do not sell, trade, or rent your personal information to third parties. We may share your information with:
• Payment processors to process transactions
• Shipping companies to deliver your orders
• Service providers who assist in operating our website
• Law enforcement when required by law

Data Security:
We implement appropriate security measures to protect your personal information. All payment transactions are encrypted using SSL technology. However, no method of transmission over the internet is 100% secure.

Your Rights:
• Access your personal information
• Request correction of inaccurate data
• Request deletion of your data
• Opt-out of marketing communications
• Withdraw consent at any time

Cookies:
We use cookies to enhance your browsing experience. You can choose to disable cookies through your browser settings, but this may affect website functionality.

Contact Us:
If you have any questions about this Privacy Policy, please contact us at:
Email: privacy@example.com
Phone: +966-XXX-XXXX",
                    'ar' => "سياسة الخصوصية

آخر تحديث: ".date('d F Y')."

خصوصيتك مهمة بالنسبة لنا. توضح سياسة الخصوصية هذه كيفية جمع معلوماتك واستخدامها والكشف عنها وحمايتها عند زيارة موقعنا الإلكتروني أو إجراء عملية شراء.

المعلومات التي نجمعها:
• المعلومات الشخصية: الاسم، عنوان البريد الإلكتروني، رقم الهاتف، عنوان الشحن، ومعلومات الفواتير
• معلومات الدفع: تفاصيل بطاقة الائتمان (تتم معالجتها بشكل آمن من خلال بوابة الدفع الخاصة بنا)
• معلومات الحساب: اسم المستخدم، كلمة المرور، وسجل الشراء
• المعلومات التقنية: عنوان IP، نوع المتصفح، معلومات الجهاز، وملفات تعريف الارتباط

كيف نستخدم معلوماتك:
• لمعالجة وتنفيذ طلباتك
• لإرسال تأكيدات الطلب وتحديثات الشحن
• للرد على استفسارات خدمة العملاء
• لتحسين موقعنا وخدماتنا
• لإرسال رسائل البريد الإلكتروني الترويجية (بموافقتك)
• للكشف عن الاحتيال ومنعه

مشاركة المعلومات:
نحن لا نبيع أو نتاجر أو نؤجر معلوماتك الشخصية لأطراف ثالثة. قد نشارك معلوماتك مع:
• معالجات الدفع لمعالجة المعاملات
• شركات الشحن لتوصيل طلباتك
• مقدمي الخدمات الذين يساعدون في تشغيل موقعنا
• جهات إنفاذ القانون عند الطلب بموجب القانون

أمان البيانات:
نحن ننفذ التدابير الأمنية المناسبة لحماية معلوماتك الشخصية. يتم تشفير جميع معاملات الدفع باستخدام تقنية SSL. ومع ذلك، لا توجد طريقة نقل عبر الإنترنت آمنة بنسبة 100٪.

حقوقك:
• الوصول إلى معلوماتك الشخصية
• طلب تصحيح البيانات غير الدقيقة
• طلب حذف بياناتك
• إلغاء الاشتراك في الاتصالات التسويقية
• سحب الموافقة في أي وقت

ملفات تعريف الارتباط:
نستخدم ملفات تعريف الارتباط لتحسين تجربة التصفح الخاصة بك. يمكنك اختيار تعطيل ملفات تعريف الارتباط من خلال إعدادات المتصفح، ولكن قد يؤثر ذلك على وظائف الموقع.

اتصل بنا:
إذا كان لديك أي أسئلة حول سياسة الخصوصية هذه، يرجى الاتصال بنا على:
البريد الإلكتروني: privacy@example.com
الهاتف: +966-XXX-XXXX",
                ],
                'meta_description' => [
                    'en' => 'Our privacy policy explains how we collect, use, and protect your personal information.',
                    'ar' => 'توضح سياسة الخصوصية لدينا كيفية جمع معلوماتك الشخصية واستخدامها وحمايتها.',
                ],
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Terms & Conditions',
                    'ar' => 'الشروط والأحكام',
                ],
                'slug' => 'terms-conditions',
                'content' => [
                    'en' => "Terms & Conditions

Last Updated: ".date('F d, Y')."

Please read these Terms and Conditions carefully before using our website or making a purchase.

1. Acceptance of Terms
By accessing and using this website, you accept and agree to be bound by these Terms and Conditions.

2. Use of Website
• You must be at least 18 years old to make a purchase
• You agree to provide accurate and complete information
• You are responsible for maintaining the confidentiality of your account
• You may not use our website for any illegal or unauthorized purpose

3. Products and Pricing
• All product descriptions and images are as accurate as possible
• Prices are subject to change without notice
• We reserve the right to limit quantities
• All prices are in Saudi Riyals (SAR) and include VAT

4. Orders and Payment
• All orders are subject to acceptance and availability
• We reserve the right to refuse or cancel any order
• Payment must be received before order processing
• We accept Visa, Mastercard, PayPal, and cash on delivery

5. Shipping and Delivery
• Delivery times are estimates and not guaranteed
• Risk of loss passes to you upon delivery
• We are not responsible for delays caused by shipping carriers
• Damaged shipments must be reported within 48 hours of delivery

6. Returns and Refunds
• Returns must be made within 30 days of delivery
• Items must be in original condition with tags attached
• Refunds will be processed within 5-7 business days
• See our Returns & Exchanges page for full details

7. Intellectual Property
• All content on this website is our property or licensed to us
• You may not reproduce, distribute, or create derivative works
• Our trademarks and logos may not be used without permission

8. Limitation of Liability
• We are not liable for indirect, incidental, or consequential damages
• Our liability is limited to the amount you paid for your order
• We do not guarantee uninterrupted or error-free website operation

9. Indemnification
You agree to indemnify and hold us harmless from any claims arising from your use of our website or violation of these Terms.

10. Changes to Terms
We reserve the right to modify these Terms at any time. Changes will be effective immediately upon posting.

11. Governing Law
These Terms are governed by the laws of Saudi Arabia. Any disputes will be resolved in Saudi courts.

12. Contact Information
If you have questions about these Terms, please contact us at:
Email: legal@example.com
Phone: +966-XXX-XXXX",
                    'ar' => "الشروط والأحكام

آخر تحديث: ".date('d F Y')."

يرجى قراءة هذه الشروط والأحكام بعناية قبل استخدام موقعنا الإلكتروني أو إجراء عملية شراء.

1. قبول الشروط
من خلال الوصول إلى هذا الموقع واستخدامه، فإنك تقبل وتوافق على الالتزام بهذه الشروط والأحكام.

2. استخدام الموقع
• يجب أن يكون عمرك 18 عامًا على الأقل لإجراء عملية شراء
• أنت توافق على تقديم معلومات دقيقة وكاملة
• أنت مسؤول عن الحفاظ على سرية حسابك
• لا يجوز لك استخدام موقعنا لأي غرض غير قانوني أو غير مصرح به

3. المنتجات والأسعار
• جميع أوصاف المنتجات والصور دقيقة قدر الإمكان
• الأسعار قابلة للتغيير دون إشعار مسبق
• نحتفظ بالحق في الحد من الكميات
• جميع الأسعار بالريال السعودي وتشمل ضريبة القيمة المضافة

4. الطلبات والدفع
• جميع الطلبات تخضع للقبول والتوافر
• نحتفظ بالحق في رفض أو إلغاء أي طلب
• يجب استلام الدفع قبل معالجة الطلب
• نقبل فيزا، ماستركارد، باي بال، والدفع عند الاستلام

5. الشحن والتسليم
• أوقات التسليم تقديرية وليست مضمونة
• ينتقل خطر الخسارة إليك عند التسليم
• نحن غير مسؤولين عن التأخيرات الناجمة عن شركات الشحن
• يجب الإبلاغ عن الشحنات التالفة في غضون 48 ساعة من التسليم

6. الإرجاع والاسترداد
• يجب إجراء الإرجاع في غضون 30 يومًا من التسليم
• يجب أن تكون المنتجات في حالتها الأصلية مع العلامات المرفقة
• سيتم معالجة المبالغ المستردة في غضون 5-7 أيام عمل
• راجع صفحة الإرجاع والاستبدال للحصول على التفاصيل الكاملة

7. الملكية الفكرية
• جميع المحتويات على هذا الموقع هي ملكنا أو مرخصة لنا
• لا يجوز لك إعادة إنتاج أو توزيع أو إنشاء أعمال مشتقة
• لا يجوز استخدام علاماتنا التجارية وشعاراتنا دون إذن

8. حد المسؤولية
• نحن غير مسؤولين عن الأضرار غير المباشرة أو العرضية أو التبعية
• تقتصر مسؤوليتنا على المبلغ الذي دفعته مقابل طلبك
• نحن لا نضمن تشغيل الموقع دون انقطاع أو خالي من الأخطاء

9. التعويض
أنت توافق على تعويضنا وإبراء ذمتنا من أي مطالبات ناشئة عن استخدامك لموقعنا أو انتهاك هذه الشروط.

10. التغييرات في الشروط
نحتفظ بالحق في تعديل هذه الشروط في أي وقت. ستكون التغييرات سارية فورًا عند النشر.

11. القانون الحاكم
تخضع هذه الشروط لقوانين المملكة العربية السعودية. سيتم حل أي نزاعات في المحاكم السعودية.

12. معلومات الاتصال
إذا كان لديك أسئلة حول هذه الشروط، يرجى الاتصال بنا على:
البريد الإلكتروني: legal@example.com
الهاتف: +966-XXX-XXXX",
                ],
                'meta_description' => [
                    'en' => 'Read our terms and conditions for important information about using our website and making purchases.',
                    'ar' => 'اقرأ شروطنا وأحكامنا للحصول على معلومات مهمة حول استخدام موقعنا وإجراء عمليات الشراء.',
                ],
                'is_active' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
