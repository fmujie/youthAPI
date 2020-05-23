<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB; 

class CreateGreetingcardWenanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 创建毕业贺卡文案表
        Schema::create('greetingcard_wenan', function (Blueprint $table) {
            $table->increments('gcw_id');
            $table->string('gcw_tag',20)->default('')->comment('贺卡标签');
            $table->string('gcw_wenan',255)->default('')->comment('贺卡文案');
            $table->timestamps();
        });
        DB::insert("INSERT INTO `greetingcard_wenan` (`gcw_id`, `gcw_tag`, `gcw_wenan`, `created_at`, `updated_at`) VALUES 
        (NULL, 'teacher', '传道授业解惑是您坚守的信念，但您带给我的远不止知识，更有漫漫人生路上的真理。', NULL, NULL),
        (NULL, 'teacher', '多少次伏案桌前，为每位学子细细批改作业，书尽人师的责任。', NULL, NULL),
        (NULL, 'teacher', '饱读诗书，细心备课，耐心答疑，为人师，您做到了因材施教，循循善诱。', NULL, NULL),
        (NULL, 'teacher', '学生一批一批的来，您一遍一遍的教，我们越来越成熟，您的鬓角却渐渐灰白。', NULL, NULL),
        (NULL, 'teacher', '您总爱把人生当成故事讲给我们听，我们知道，您怕我们重蹈覆辙。', NULL, NULL),
        (NULL, 'teacher', '一日为师，终身为父，您是好老师，更是大家长，我们的学习您从未缺席。', NULL, NULL),
        (NULL, 'teacher', '世界那么大路途那么远，可您放弃繁华迷人的世界，选择陪伴我们成长。', NULL, NULL),
        (NULL, 'teacher', '师恩难忘，即使我辈济济无名，也愿为您肝脑涂地。', NULL, NULL),
        (NULL, 'teacher', '您教给我们的知识一点点绘成灿烂的世界，让我们知道前途无量，未来可期。', NULL, NULL),
        (NULL, 'teacher', '您是闪闪的一点光辉，是我们生命中抹不去的痕迹。', NULL, NULL),
        
        (NULL, 'tutor', '后来我遇见了您，陪我走过一个个春秋冬夏。', NULL, NULL),
        (NULL, 'tutor', '从那年夏天遇见了你，你变成了我四年中不可或缺的那个人。', NULL, NULL),
        (NULL, 'tutor', '我知道即使我们离开，你仍会把我们挂在心间，不曾忘记。', NULL, NULL),
        (NULL, 'tutor', '来时我们还是懵懂幼稚的少年，你陪我们变成了独当一面的青年。', NULL, NULL),
        (NULL, 'tutor', '一次次的关心，一句句的叮咛，都是您在我脑海里的印记。', NULL, NULL),
        (NULL, 'tutor', '您站在原地看着我们就好，我们会长大、变优秀，然后成为你的骄傲。', NULL, NULL),
        (NULL, 'tutor', '我知道您的孩子很多，但我更懂每一个孩子都是您心中最特别的那个。', NULL, NULL),
        (NULL, 'tutor', '请您放心吧，您的嘱咐我会一直记得，做一个对社会有用的人。', NULL, NULL),
        (NULL, 'tutor', '时间总是在不知不觉间逝去，到了我该走的时候了，勿念。', NULL, NULL),
        (NULL, 'tutor', '前方漫漫，还有孩子在等着您，还有前方在等着我，祝彼此安好。', NULL, NULL),
        
        (NULL, 'roommate', '我们说好做彼此的伴娘，又怎能轻易分离。', NULL, NULL),
        (NULL, 'roommate', '你懂我的傻傻呆呆，陪我一起可可爱爱。', NULL, NULL),
        (NULL, 'roommate', '分离是人生成长的磨难，但感情不是一句毕业可以抵消的。', NULL, NULL),
        (NULL, 'roommate', '聚餐、狂欢是我们的传统，包容、体谅是我们对友情的诠释。', NULL, NULL),
        (NULL, 'roommate', '见过你的狼狈，陪过你的辉煌，我们间的一点一滴我从不敢忘记。', NULL, NULL),
        (NULL, 'roommate', '这些年一起偷看过的帅哥，抄过的作业，我都会好好封存在我的回忆。', NULL, NULL),
        (NULL, 'roommate', '磕磕绊绊的四年同居生活，你们已经成为我难以割舍的青春。', NULL, NULL),
        (NULL, 'roommate', '你们是我生命中的星星，一起组成了我的浩瀚星图。', NULL, NULL),
        (NULL, 'roommate', '你们会想我的吧，想起我们的宿舍，想起我们曾经的快乐。', NULL, NULL),
        (NULL, 'roommate', '未来没有我陪伴的路，你们也要坚定的走下去，我们来日再见。', NULL, NULL),
        
        (NULL, 'workmate', '你懂我未说出口话，因为默契是我们磨合的成果。', NULL, NULL),
        (NULL, 'workmate', '习惯了你在我身边的陪伴，舍不得你我间无需言语的心领神会。', NULL, NULL),
        (NULL, 'workmate', '我懂你的优秀，希望来日你我再见时你还是那个翩翩少年郎。', NULL, NULL),
        (NULL, 'workmate', '一起分配工作，共同承担失误，我们一直是彼此的后背。', NULL, NULL),
        (NULL, 'workmate', '我们一起熬过的夜都是你我一步步变优秀的见证者。', NULL, NULL),
        (NULL, 'workmate', '和你们一起碰撞过的火花，庆祝过的聚会，一直是我前进的动力。', NULL, NULL),
        (NULL, 'workmate', '并肩作战的日子总是难得，下一次相聚我们会遇见更好的彼此。', NULL, NULL),
        (NULL, 'workmate', '我的每一份成绩都掺杂这你的汗水，我们都已经是对方最显眼的成绩单。', NULL, NULL),
        (NULL, 'workmate', '你我新的工作已经提上日程，新的伙伴会替我陪你走完接下来的路。', NULL, NULL),
        (NULL, 'workmate', '纵有千古，横有八荒，愿你未来可期，前途无量。', NULL, NULL),
        
        (NULL, 'driver', '穿过林荫道，绕过稷下湖，你陪我走遍整个校园的春秋。', NULL, NULL),
        (NULL, 'driver', '不论多远，不管多晚，那个绿色的身影一直在不远处等我。', NULL, NULL),
        (NULL, 'driver', '熟悉的座位，难忘的叮咛，您带我走过的风景是那么盎然。', NULL, NULL),
        (NULL, 'driver', '有您陪伴的夏天不再炎热暴躁，有您走过的冬天不再寒冷冻人。', NULL, NULL),
        (NULL, 'driver', '我在小绿龙上吹过的每一缕风，都有您的味道和笑容。', NULL, NULL),
        (NULL, 'driver', '来时坐着小绿龙环游校园，也乘着小绿龙结束四年青春。', NULL, NULL),
        (NULL, 'driver', '四年里，无数次乘着小绿龙奔向教室，无数次坐在后排听风慢慢吹过。', NULL, NULL),
        (NULL, 'driver', '还记得刚来时，一边乘车一边听您讲学校的路线，亲切的话语让我不在孤独。', NULL, NULL),
        (NULL, 'driver', '毕业之前，我还要再坐一次小绿龙，穿过校园，感受山理的夏天。', NULL, NULL),
        (NULL, 'driver', '夏天的风缓缓吹过，感谢您陪伴我的四年。', NULL, NULL),
        
        (NULL, 'lover', '想再跟你泡一次图书馆，抬头时看到你认真的模样，我觉得浑身动力满满。', NULL, NULL),
        (NULL, 'lover', '最喜欢和你一起参加活动，那只需一个眼神就懂的默契让人着迷。', NULL, NULL),
        (NULL, 'lover', '我们一起制定目标、描绘未来的蓝图，一起为彼此加油，一起期待明天。', NULL, NULL),
        (NULL, 'lover', '谢谢你和我并肩作战，我们都要努力，一起去看看山顶的风景。', NULL, NULL),
        (NULL, 'lover', ' 一想到要和你一起创造未来，我就对未来充满期待。', NULL, NULL),
        (NULL, 'lover', '想和你再去奶茶店买第二杯半价，想和你再去操场散步看星星。', NULL, NULL),
        (NULL, 'lover', '几百页的聊天记录，都比不上我们一模一样的一张张证书。', NULL, NULL),
        (NULL, 'lover', '一起背过的单词，一起备战过的考试，一起努力上进，让我觉得有你真好。', NULL, NULL),
        (NULL, 'lover', '我已经把和你的未来都规划好了，你愿意和我一起为之努力吗？', NULL, NULL),
        (NULL, 'lover', '手牵手，不畏人海的拥挤，我想和你看一看永远。', NULL, NULL),
        
        (NULL, 'myself', '大学四年，转眼间，你也要穿上学士服、戴上学士帽了。', NULL, NULL),
        (NULL, 'myself', '你看过清晨六点的朝阳，也看过夜晚十二点的星空，勤勤恳恳，披星戴月。', NULL, NULL),
        (NULL, 'myself', '时光荏苒，总觉得时间很长，好像怎么也过不完，总以为时光漫漫，来日方长，可四年经不起等待，终于也要和大学的自己说再见。', NULL, NULL),
        (NULL, 'myself', '希望你能成为对社会有用的人，希望你可以活在自己的热爱里啊。', NULL, NULL),
        (NULL, 'myself', '以后的人生，要活得积极、明亮，以后的路，要走得坚定、潇洒，练就自我的定力、独立的声音和成熟的灵魂，', NULL, NULL),
        (NULL, 'myself', '哭过，笑过，遗憾过，喜悦过，看着还算丰硕的过往，庆幸自己的坚持与努力，这是我人生中最美好的经历。', NULL, NULL),
        (NULL, 'myself', '好好生活，慢慢相遇，带着这四年的苦与乐，继续向前。', NULL, NULL),
        (NULL, 'myself', '再见啦，稷下湖的大白鹅；再见啦，穿梭校园的小绿龙；再见啦，校园时期的自己。', NULL, NULL),
        (NULL, 'myself', '不要因为错过太阳哭泣，还有群星在为你闪烁，没完成的英雄梦要继续坚持。', NULL, NULL),
        (NULL, 'myself', '愿你走出半生，归来仍是少年。', NULL, NULL),
        
        (NULL, 'freshmen', '看到青涩、稚嫩的你们，就像看到曾经的自己，所以给予了更多期望在你们身上。', NULL, NULL),
        (NULL, 'freshmen', '看着你们从懵懂变得能够独当一面，甚至比当初的我们还优秀，我真为你们高兴。', NULL, NULL),
        (NULL, 'freshmen', '未来掌握在自己手里，想做的事情要勇敢地做，想见到的人要奔跑着相遇。', NULL, NULL),
        (NULL, 'freshmen', '热爱可抵岁月漫长，一定不要辜负青春，不要辜负时光，不要辜负自己。', NULL, NULL),
        (NULL, 'freshmen', '把喜欢的事情做好，把自己的梦编织好，祝愿你们前程似锦。', NULL, NULL),
        (NULL, 'freshmen', '请好好爱惜自己的身体，不要熬夜，身体才是革命的本钱。', NULL, NULL),
        (NULL, 'freshmen', '自律、勤奋、上进、努力，是你一生的修行，要在大学时期做最好的自己。', NULL, NULL),
        (NULL, 'freshmen', '在这个快节奏时代，仍然要有自己的信仰，一张安静的书桌来之不易，不能只安放没有思想的头颅。', NULL, NULL),
        (NULL, 'freshmen', '当你决定做一件事情的时候，全世界都会为你让路。', NULL, NULL),
        (NULL, 'freshmen', '前路浩浩荡荡，未来皆可期待，经过时间的打磨，你们会变成更优秀的人。', NULL, NULL),
        
        (NULL, 'suguan', '每天回到宿舍，最期盼听到的就是您的那声“回来啦，吃饭了吗？”', NULL, NULL),
        (NULL, 'suguan', '这四年，生病的时候有您照顾，不开心的时候有您安慰，宿舍的安全有您守护。', NULL, NULL),
        (NULL, 'suguan', '我们和您分享零食，您提醒我们天冷多加衣。', NULL, NULL),
        (NULL, 'suguan', '我们走了您还有下一届同学，而您是我们的大学里唯一、最亲爱的阿姨。', NULL, NULL),
        (NULL, 'suguan', '下雨时收好的衣服，天冷时的暖手袋，小黑板上的温馨提示，是我大学四年最温暖的回忆。', NULL, NULL),
        (NULL, 'suguan', '干净明亮的宿舍，舒适的环境，感谢您在四年守护属于我们的小家。', NULL, NULL),
        (NULL, 'suguan', '每天早上的一句早安，不开心时的聊天疏导，一幕幕仍在眼前。', NULL, NULL),
        (NULL, 'suguan', '看到宿舍门前您甜甜的微笑，一整天的疲惫和烦恼都会放下。', NULL, NULL),
        (NULL, 'suguan', '远行千里，您是我在校园温暖的港湾。', NULL, NULL),
        (NULL, 'suguan', '您总能看见我隐藏起来的不开心，总会在我失魂落魄是给我关照。', NULL, NULL),
        
        (NULL, 'classmates', '愿你看过浮生万物也预览山河无数，依然坚强温暖。', NULL, NULL),
        (NULL, 'classmates', '你要抵达山川湖海，把沿途每一帧星芒讲给我听。', NULL, NULL),
        (NULL, 'classmates', '结伴去教室，结伴去厕所，结伴去餐厅……我们还要结伴度过余生。', NULL, NULL),
        (NULL, 'classmates', '一个班级，四十位同学，共度四年，今后，我们江湖再见。', NULL, NULL),
        (NULL, 'classmates', '我懂你的优秀，希望来日再见时你还是那个翩翩少年郎。', NULL, NULL),
        (NULL, 'classmates', '和你们一起碰撞过的火花，参加过的聚会，都会是我永恒的记忆。', NULL, NULL),
        (NULL, 'classmates', '并肩作战的日子总是难得，下一次相聚我们会遇见更好的彼此。', NULL, NULL),
        (NULL, 'classmates', '班级的每份荣誉，得到的每份嘉奖，都掺杂着我们的汗水，都是我们一生的荣誉。', NULL, NULL),
        (NULL, 'classmates', '你的好友关系已到期，请发送520申请续约1314年。', NULL, NULL),
        (NULL, 'classmates', '纵有千古，横有八荒，愿你们未来可期，未来可期。', NULL, NULL),
        
        (NULL, 'friends', '总有些惊奇的际遇，比方说当我遇见你。', NULL, NULL),
        (NULL, 'friends', '我们一起在校园生活的点滴，都是成长的温暖时刻。', NULL, NULL),
        (NULL, 'friends', '窗外的风是床单刚晾干的浅蓝色，身边的你是月亮递给我的小星星。', NULL, NULL),
        (NULL, 'friends', '夏天的风我永远记得，那是我们一起穿小裙子的季节。', NULL, NULL),
        (NULL, 'friends', '与你分享过的青春，是我们一起努力进步的足迹。', NULL, NULL),
        (NULL, 'friends', '所有让人快乐的风景里都有你。', NULL, NULL),
        (NULL, 'friends', '我们没有长篇大论的友情语录，只有见面时的无话不谈和开怀大笑。', NULL, NULL),
        (NULL, 'friends', '难过的时候记得告诉我，我一直在你身旁。', NULL, NULL),
        (NULL, 'friends', '我们即将奔赴不同的人生，但未来的我们永远是我们。', NULL, NULL),
        (NULL, 'friends', ' 我们不是春季限定，我们是来日方长。', NULL, NULL),
        
        (NULL, 'leader', ' 你们精心策划的每一项班级活动，都是我们相聚的快乐时光。', NULL, NULL),
        (NULL, 'leader', '是你们的付出，让这个班级更加有温度。', NULL, NULL),
        (NULL, 'leader', '我们每个人的一小部分，是你们的大部分，你们的辛苦是我们心底的温暖。', NULL, NULL),
        (NULL, 'leader', '每一次的“@全体成员”，都给我稳稳的安全感。', NULL, NULL),
        (NULL, 'leader', '熬夜做表，熬夜整理资料，每一次的催促都是一份真诚的爱。', NULL, NULL),
        (NULL, 'leader', '四年相伴，你们的优秀，是我们的向往和目标。', NULL, NULL),
        (NULL, 'leader', '每一次失意时的鼓励，每一次迷茫时的指引，都是我步步成长的力量。', NULL, NULL),
        (NULL, 'leader', '有你们在，我不孤单。', NULL, NULL),
        (NULL, 'leader', '天南海北的依恋，因为你们，我们才是我们。', NULL, NULL),
        (NULL, 'leader', '要努力，要上进，期待更优秀的彼此！', NULL, NULL),
        
        (NULL, 'cook', '一勺米饭，一份饭菜，浇筑的是茁壮成长的学生。', NULL, NULL),
        (NULL, 'cook', '寂静的夜晚，朦胧的清晨，您陪我从白天到黑夜。', NULL, NULL),
        (NULL, 'cook', '即使分离即将到来，我仍会想念您脸上热切的笑容。', NULL, NULL),
        (NULL, 'cook', '够不够，吃饱了吗，只有发自肺腑的关心才能如此难以让人忘怀。', NULL, NULL),
        (NULL, 'cook', '我难过时，窗口后的身影是安慰；我快乐时，窗口后的身影是欣慰。', NULL, NULL),
        (NULL, 'cook', '四年时间走走停停，您一直在我身旁，从未走远。', NULL, NULL),
        (NULL, 'cook', '每一次在食堂吃饭，都不禁想象您做饭时慈爱的身影。', NULL, NULL),
        (NULL, 'cook', '我胖的每一两，长高的每一分，都离不开您满口生香的饭菜。', NULL, NULL),
        (NULL, 'cook', '一顿又一顿，感谢师傅让我四年我胖了n斤。', NULL, NULL),
        (NULL, 'cook', '阿姨，下一次再来，手不要抖啦。', NULL, NULL),
        
        (NULL, 'waimai', '一个电话，一条短信，你把天南海北的祝福带到我身边。', NULL, NULL),
        (NULL, 'waimai', '炎炎夏日，凛冽寒冬，你的电话从未缺席。', NULL, NULL),
        (NULL, 'waimai', '你见证我的每一次到来和离开，四年的光阴他人岂能替代。', NULL, NULL),
        (NULL, 'waimai', '你的电动车一直载着我对你殷殷切切的期待和盼望。', NULL, NULL),
        (NULL, 'waimai', '我是您耳熟能详的名字，您是我朝夕相处的小哥。', NULL, NULL),
        (NULL, 'waimai', '生活艰辛，工作忙碌，但请注意身体，相互保重。', NULL, NULL),
        (NULL, 'waimai', '大街小巷，白天黑夜，奔波是您的使命，安全送达是您的骄傲。', NULL, NULL),
        (NULL, 'waimai', '您在每一个快递箱上写的名字，都是您曾在我大学中的印记。', NULL, NULL),
        (NULL, 'waimai', '快递默认地址还是舍不得改，还想在从您的手里接过包裹。', NULL, NULL),
        (NULL, 'waimai', '请您帮我把四年记忆打包发出，收件人十年后的我。', NULL, NULL),
        
        (NULL, 'baoan', '风雨中巡逻，烈阳下站岗，用心守护山理校园。', NULL, NULL),
        (NULL, 'baoan', '没有鲜艳亮丽的服饰，从来不说豪言壮语，有你们山理工人就不会担心。', NULL, NULL),
        (NULL, 'baoan', '无论寒冬酷暑，亦或风吹雨淋，您用坚挺的脊背撑起了校园安全。', NULL, NULL),
        (NULL, 'baoan', '看见您时，您总在微笑，这份笑容仿佛会传染，透过时光，希望微笑陪伴您一个又一个四年。', NULL, NULL),
        (NULL, 'baoan', '您挺拔且温暖的身影以温暖而美好的姿态定格，停留在我们的记忆。', NULL, NULL),
        (NULL, 'baoan', '捡起地上的垃圾，摆好楼前的小蓝车，是职责之外也是心底的温柔。', NULL, NULL),
        (NULL, 'baoan', '初到山理，您看我独自一人，帮我拉着行李穿过大半个校园安全送到宿舍楼前，外表霸气实则温暖。', NULL, NULL),
        (NULL, 'baoan', '10：30的自习室外，您从不催促只默默守护，', NULL, NULL),
        (NULL, 'baoan', '临熄灯前回寝室，您打着灯陪伴在身后，照亮那个大雾的夜晚，也照亮了我对您的感激和敬佩。', NULL, NULL)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('greetingcard_wenan');
    }
}
