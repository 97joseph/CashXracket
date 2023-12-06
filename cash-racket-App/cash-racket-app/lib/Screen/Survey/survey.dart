import 'package:cash_rocket/Screen/Scratch%20Card/use_scratch_card.dart';
import 'package:cash_rocket/Screen/Visit%20Website/play_video.dart';
import 'package:feather_icons/feather_icons.dart';
import 'package:flutter/material.dart';
import 'package:nb_utils/nb_utils.dart';

import '../Constant Data/constant.dart';
class SurveyScreen extends StatefulWidget {
  const SurveyScreen({Key? key}) : super(key: key);

  @override
  State<SurveyScreen> createState() => _SurveyScreenState();
}

class _SurveyScreenState extends State<SurveyScreen> {


  bool isBalanceShow = false;
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        titleSpacing: 0,
        toolbarHeight: 90,
        shape: const RoundedRectangleBorder(
          borderRadius: BorderRadius.only(
            bottomRight: Radius.circular(30.0),
            bottomLeft: Radius.circular(30.0),
          ),
        ),
        backgroundColor: kMainColor,
        elevation: 0.0,
        title: Text(
          'Survey',
          style: kTextStyle.copyWith(color: Colors.white),
        ),
        actions: [
          Padding(
            padding: const EdgeInsets.all(30.0),
            child: Container(
              padding: const EdgeInsets.all(2.0),
              decoration: BoxDecoration(
                borderRadius: BorderRadius.circular(30.0),
                color: Colors.white.withOpacity(0.3),
                border: Border.all(
                  color: Colors.white,
                ),
              ),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  AnimatedOpacity(
                    opacity: !isBalanceShow ? 1.0 : 0.0,
                    duration: const Duration(milliseconds: 1000),
                    child: Container(
                      height: 20,
                      width: 20,
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(30.0),
                        color: kMainColor,
                        border: Border.all(color: Colors.white, width: 2.0),
                      ),
                      child: const Icon(
                        FeatherIcons.dollarSign,
                        size: 15.0,
                      ),
                    ),
                  ),
                  const SizedBox(width: 5.0),
                  Text(isBalanceShow ? '1200' : 'Balance'),
                  const SizedBox(width: 5.0),
                  AnimatedOpacity(
                    opacity: isBalanceShow ? 1.0 : 0.0,
                    duration: const Duration(milliseconds: 1000),
                    child: Container(
                      height: 20,
                      width: 20,
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(30.0),
                        color: kMainColor,
                        border: Border.all(color: Colors.white, width: 2.0),
                      ),
                      child: const Icon(
                        FeatherIcons.dollarSign,
                        size: 15.0,
                      ),
                    ),
                  ),
                ],
              ),
            ).onTap(() {
              setState(() {
                isBalanceShow = !isBalanceShow;
              });
            }),
          ),
        ],
      ),
      body: Padding(
        padding: const EdgeInsets.all(10.0),
        child: SingleChildScrollView(
          child: Column(
            children: [
              const SizedBox(height: 10,),
              Container(
                decoration: BoxDecoration(
                  borderRadius: BorderRadius.circular(10),
                  color: Colors.white,
                  border: Border.all(color: kBorderColorTextField,width: 0.5),
                  boxShadow: const [
                    BoxShadow(
                      color: kDarkWhite,
                      offset: Offset(5, 5),
                      blurRadius: 10.0,
                      spreadRadius: 2.0
                    )
                  ]
                ),
                child: ListTile(
                  visualDensity: const VisualDensity(horizontal: -1),
                  contentPadding: const EdgeInsets.symmetric(horizontal: 10,vertical: 5),
                  leading: Image.asset('images/b1.png',height: 40,width: 40,),
                  title: const Text('Inbrain',style: TextStyle(fontWeight: FontWeight.w500,color: kTitleColor),),
                  trailing: const Icon(Icons.arrow_forward_ios,size: 18,color: kGreyTextColor,),
                ),
              ),
              const SizedBox(height: 20,),
              Container(
                decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(10),
                    color: Colors.white,
                    border: Border.all(color: kBorderColorTextField,width: 0.5),
                    boxShadow: const [
                      BoxShadow(
                          color: kDarkWhite,
                          offset: Offset(5, 5),
                          blurRadius: 10.0,
                          spreadRadius: 2.0
                      )
                    ]
                ),
                child: ListTile(
                  visualDensity: const VisualDensity(horizontal: -1),
                  contentPadding: const EdgeInsets.symmetric(horizontal: 10,vertical: 5),
                  leading: Image.asset('images/b2.png',height: 40,width: 40,),
                  title: const Text('Bitrise',style: TextStyle(fontWeight: FontWeight.w500,color: kTitleColor),),
                  trailing: const Icon(Icons.arrow_forward_ios,size: 18,color: kGreyTextColor,),
                ),
              ),
              const SizedBox(height: 20,),
              Container(
                decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(10),
                    color: Colors.white,
                    border: Border.all(color: kBorderColorTextField,width: 0.5),
                    boxShadow: const [
                      BoxShadow(
                          color: kDarkWhite,
                          offset: Offset(5, 5),
                          blurRadius: 10.0,
                          spreadRadius: 2.0
                      )
                    ]
                ),
                child: ListTile(
                  visualDensity: const VisualDensity(horizontal: -1),
                  contentPadding: const EdgeInsets.symmetric(horizontal: 10,vertical: 5),
                  leading: Image.asset('images/b3.png',height: 40,width: 40,),
                  title: const Text('Pollfish',style: TextStyle(fontWeight: FontWeight.w500,color: kTitleColor),),
                  trailing: const Icon(Icons.arrow_forward_ios,size: 18,color: kGreyTextColor,),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
