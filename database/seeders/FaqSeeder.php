<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => [
                    'en' => 'How do I place an order?',
                    'ar' => 'كيف يمكنني تقديم طلب؟',
                ],
                'answer' => [
                    'en' => 'To place an order, browse our products, add items to your cart, and proceed to checkout. Fill in your shipping details and payment information to complete your purchase.',
                    'ar' => 'لتقديم طلب، تصفح منتجاتنا، أضف المنتجات إلى سلتك، ثم انتقل إلى صفحة الدفع. قم بملء تفاصيل الشحن ومعلومات الدفع لإتمام عملية الشراء.',
                ],
                'is_active' => true,
                'order' => 1,
            ],
            [
                'question' => [
                    'en' => 'What payment methods do you accept?',
                    'ar' => 'ما هي طرق الدفع التي تقبلونها؟',
                ],
                'answer' => [
                    'en' => 'We accept Visa, Mastercard, PayPal, and cash on delivery (COD). All online payments are processed securely through our payment gateway.',
                    'ar' => 'نقبل فيزا، ماستركارد، باي بال، والدفع عند الاستلام. جميع المدفوعات الإلكترونية تتم معالجتها بشكل آمن من خلال بوابة الدفع الخاصة بنا.',
                ],
                'is_active' => true,
                'order' => 2,
            ],
            [
                'question' => [
                    'en' => 'How long does shipping take?',
                    'ar' => 'كم من الوقت يستغرق الشحن؟',
                ],
                'answer' => [
                    'en' => 'Shipping typically takes 3-7 business days depending on your location. Express shipping options are available for faster delivery. You will receive a tracking number once your order is shipped.',
                    'ar' => 'عادة ما يستغرق الشحن من 3 إلى 7 أيام عمل حسب موقعك. تتوفر خيارات الشحن السريع للتوصيل الأسرع. ستتلقى رقم تتبع بمجرد شحن طلبك.',
                ],
                'is_active' => true,
                'order' => 3,
            ],
            [
                'question' => [
                    'en' => 'Do you offer free shipping?',
                    'ar' => 'هل تقدمون شحن مجاني؟',
                ],
                'answer' => [
                    'en' => 'Yes! We offer free standard shipping on all orders over $100. Orders below $100 have a flat shipping fee of $10.',
                    'ar' => 'نعم! نقدم شحن مجاني على جميع الطلبات التي تزيد عن 100 دولار. الطلبات الأقل من 100 دولار لديها رسوم شحن ثابتة قدرها 10 دولارات.',
                ],
                'is_active' => true,
                'order' => 4,
            ],
            [
                'question' => [
                    'en' => 'Can I track my order?',
                    'ar' => 'هل يمكنني تتبع طلبي؟',
                ],
                'answer' => [
                    'en' => 'Yes, once your order is shipped, you will receive an email with a tracking number. You can use this number to track your order on our website or the courier\'s website.',
                    'ar' => 'نعم، بمجرد شحن طلبك، ستتلقى بريدًا إلكترونيًا يحتوي على رقم التتبع. يمكنك استخدام هذا الرقم لتتبع طلبك على موقعنا أو موقع شركة الشحن.',
                ],
                'is_active' => true,
                'order' => 5,
            ],
            [
                'question' => [
                    'en' => 'What is your return policy?',
                    'ar' => 'ما هي سياسة الإرجاع الخاصة بكم؟',
                ],
                'answer' => [
                    'en' => 'We offer a 30-day return policy for most items. Products must be unused and in their original packaging. Refunds are processed within 5-7 business days after we receive your return.',
                    'ar' => 'نقدم سياسة إرجاع لمدة 30 يومًا لمعظم المنتجات. يجب أن تكون المنتجات غير مستخدمة وفي عبواتها الأصلية. يتم معالجة المبالغ المستردة في غضون 5-7 أيام عمل بعد استلامنا لإرجاعك.',
                ],
                'is_active' => true,
                'order' => 6,
            ],
            [
                'question' => [
                    'en' => 'How do I return a product?',
                    'ar' => 'كيف يمكنني إرجاع منتج؟',
                ],
                'answer' => [
                    'en' => 'To return a product, contact our customer service team to initiate a return request. We will provide you with a return shipping label and instructions. Pack the item securely and ship it back to us.',
                    'ar' => 'لإرجاع منتج، اتصل بفريق خدمة العملاء لدينا لبدء طلب الإرجاع. سنزودك بملصق شحن الإرجاع والتعليمات. قم بتغليف المنتج بشكل آمن وأرسله إلينا.',
                ],
                'is_active' => true,
                'order' => 7,
            ],
            [
                'question' => [
                    'en' => 'Are your products authentic?',
                    'ar' => 'هل منتجاتكم أصلية؟',
                ],
                'answer' => [
                    'en' => 'Yes, all our products are 100% authentic and sourced directly from authorized distributors and manufacturers. We guarantee the quality and authenticity of every item we sell.',
                    'ar' => 'نعم، جميع منتجاتنا أصلية بنسبة 100% ومصدرها مباشرة من الموزعين والمصنعين المعتمدين. نحن نضمن جودة وأصالة كل منتج نبيعه.',
                ],
                'is_active' => true,
                'order' => 8,
            ],
            [
                'question' => [
                    'en' => 'Can I cancel my order?',
                    'ar' => 'هل يمكنني إلغاء طلبي؟',
                ],
                'answer' => [
                    'en' => 'You can cancel your order within 24 hours of placing it. Once the order has been shipped, it cannot be cancelled, but you can return it once you receive it.',
                    'ar' => 'يمكنك إلغاء طلبك في غضون 24 ساعة من تقديمه. بمجرد شحن الطلب، لا يمكن إلغاؤه، ولكن يمكنك إرجاعه بمجرد استلامه.',
                ],
                'is_active' => true,
                'order' => 9,
            ],
            [
                'question' => [
                    'en' => 'Do you ship internationally?',
                    'ar' => 'هل تشحنون دوليًا؟',
                ],
                'answer' => [
                    'en' => 'Currently, we only ship within Saudi Arabia. We are working on expanding our shipping to other countries in the region. Stay tuned for updates!',
                    'ar' => 'حاليًا، نحن نشحن فقط داخل المملكة العربية السعودية. نحن نعمل على توسيع خدمة الشحن إلى دول أخرى في المنطقة. ترقبوا التحديثات!',
                ],
                'is_active' => true,
                'order' => 10,
            ],
            [
                'question' => [
                    'en' => 'How can I contact customer support?',
                    'ar' => 'كيف يمكنني الاتصال بخدمة العملاء؟',
                ],
                'answer' => [
                    'en' => 'You can reach our customer support team via email at support@example.com or call us at +966-XXX-XXXX. Our team is available 24/7 to assist you.',
                    'ar' => 'يمكنك التواصل مع فريق خدمة العملاء عبر البريد الإلكتروني على support@example.com أو الاتصال بنا على +966-XXX-XXXX. فريقنا متاح على مدار الساعة طوال أيام الأسبوع لمساعدتك.',
                ],
                'is_active' => true,
                'order' => 11,
            ],
            [
                'question' => [
                    'en' => 'Do you offer gift wrapping?',
                    'ar' => 'هل تقدمون خدمة تغليف الهدايا؟',
                ],
                'answer' => [
                    'en' => 'Yes, we offer gift wrapping services for an additional fee of $5. You can select this option during checkout and add a personalized message.',
                    'ar' => 'نعم، نقدم خدمات تغليف الهدايا مقابل رسوم إضافية قدرها 5 دولارات. يمكنك اختيار هذا الخيار أثناء عملية الدفع وإضافة رسالة شخصية.',
                ],
                'is_active' => true,
                'order' => 12,
            ],
            [
                'question' => [
                    'en' => 'What should I do if I receive a damaged product?',
                    'ar' => 'ماذا يجب أن أفعل إذا استلمت منتجًا تالفًا؟',
                ],
                'answer' => [
                    'en' => 'If you receive a damaged product, please contact us immediately with photos of the damage. We will arrange a replacement or full refund at no additional cost to you.',
                    'ar' => 'إذا استلمت منتجًا تالفًا، يرجى الاتصال بنا على الفور مع صور للضرر. سنقوم بترتيب استبدال أو استرداد كامل للمبلغ دون أي تكلفة إضافية.',
                ],
                'is_active' => true,
                'order' => 13,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
