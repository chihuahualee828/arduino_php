
unsigned long eventTime3=3000; // temp
unsigned long eventTime1=3000;
unsigned long eventTime2=5000;

unsigned long previousTime1=0;
unsigned long previousTime2=0;
unsigned long previousTime3=0;

//step motor
#define STEPPER_PIN_1 9
#define STEPPER_PIN_2 10
#define STEPPER_PIN_3 11
#define STEPPER_PIN_4 12
#include <OneWire.h>
#include <DallasTemperature.h>

// Data wire is plugged into digital pin 2 on the Arduino
#define ONE_WIRE_BUS 2
// Setup a oneWire instance to communicate with any OneWire device
OneWire oneWire(ONE_WIRE_BUS);  
// Pass oneWire reference to DallasTemperature library
DallasTemperature sensors(&oneWire);


int step_number = 0;
int waterLevel;
char ch;
String line;
String onOff="off";
int interval;
//int index=0;
void setup() {
  sensors.begin();
  Serial.begin(9600);
  pinMode(STEPPER_PIN_1, OUTPUT);
  pinMode(STEPPER_PIN_2, OUTPUT);
  pinMode(STEPPER_PIN_3, OUTPUT);
  pinMode(STEPPER_PIN_4, OUTPUT);


}

void loop() {


  
  
  if(Serial.available()>0){
    //ch= Serial.read();
    line= Serial.readString();
    if(line.indexOf("water_level_interval")!=-1){
      interval=line.substring(21, -1).toInt(); 
      //(index, -1) index is the index of the first number in string
      eventTime1=interval*1000;
    }
    if(line.indexOf("temp_interval")!=-1){
      interval=line.substring(14, -1).toInt(); 
      //(index, -1) index is the index of the first number in string
      eventTime3=interval*1000;
    }
    if(line.indexOf("turb_interval")!=-1){
      interval=line.substring(14, -1).toInt(); 
      //(index, -1) index is the index of the first number in string
      eventTime2=interval*1000;
    }
    
   }

  
  
  
  unsigned long currentTime = millis();

  if(currentTime - previousTime3 >= eventTime3){
    
    sensors.requestTemperatures(); 
    Serial.println("Temperature: "+ String(sensors.getTempCByIndex(0)));
    previousTime3= currentTime;
    
    
  }
  
//water level
  if(currentTime - previousTime1 >= eventTime1){
    waterLevel=analogRead(A5);
    Serial.println("LevelVoltage: "+String(waterLevel));
    if(waterLevel<=100){
      Serial.println("Level: Empty");
    }
    else if(waterLevel>100 && waterLevel<=300){
      Serial.println("Level: Low");
    }
    else if(waterLevel>300 && waterLevel<=330){
      Serial.println("Level: Medium");
    }
    else if(waterLevel>330){
      Serial.println("Level: High");
    }
    previousTime1= currentTime;
  }
//--------------


//turbidity
  if(currentTime - previousTime2 >= eventTime2){
    int sensorValue = analogRead(A0);// read the input on analog pin 0:
    float voltage = sensorValue * (5.0 / 1024.0); // Convert the analog reading (which goes from 0 - 1023) to a voltage (0 - 5V):
    Serial.println("Turb: "+ String(voltage));
    previousTime2= currentTime;
  }
//--------------



////Step motor
//  if(Serial.available()>0){
//    ch= Serial.read();
//    if(ch!='f'){
//      onOff="on";
//    }else{
//      onOff="off";
//    }
//   }
//   if(onOff.equals("on")){
//      OneStep(true);
//      delay(2);
//   }
////-------------------
//  
  
}


//void OneStep(bool dir){
//    if(dir){
//switch(step_number){
//  case 0:
//  digitalWrite(STEPPER_PIN_1, HIGH);
//  digitalWrite(STEPPER_PIN_2, LOW);
//  digitalWrite(STEPPER_PIN_3, LOW);
//  digitalWrite(STEPPER_PIN_4, LOW);
//  break;
//  case 1:
//  digitalWrite(STEPPER_PIN_1, LOW);
//  digitalWrite(STEPPER_PIN_2, HIGH);
//  digitalWrite(STEPPER_PIN_3, LOW);
//  digitalWrite(STEPPER_PIN_4, LOW);
//  break;
//  case 2:
//  digitalWrite(STEPPER_PIN_1, LOW);
//  digitalWrite(STEPPER_PIN_2, LOW);
//  digitalWrite(STEPPER_PIN_3, HIGH);
//  digitalWrite(STEPPER_PIN_4, LOW);
//  break;
//  case 3:
//  digitalWrite(STEPPER_PIN_1, LOW);
//  digitalWrite(STEPPER_PIN_2, LOW);
//  digitalWrite(STEPPER_PIN_3, LOW);
//  digitalWrite(STEPPER_PIN_4, HIGH);
//  break;
//} 
//  }else{
//    switch(step_number){
//  case 0:
//  digitalWrite(STEPPER_PIN_1, LOW);
//  digitalWrite(STEPPER_PIN_2, LOW);
//  digitalWrite(STEPPER_PIN_3, LOW);
//  digitalWrite(STEPPER_PIN_4, HIGH);
//  break;
//  case 1:
//  digitalWrite(STEPPER_PIN_1, LOW);
//  digitalWrite(STEPPER_PIN_2, LOW);
//  digitalWrite(STEPPER_PIN_3, HIGH);
//  digitalWrite(STEPPER_PIN_4, LOW);
//  break;
//  case 2:
//  digitalWrite(STEPPER_PIN_1, LOW);
//  digitalWrite(STEPPER_PIN_2, HIGH);
//  digitalWrite(STEPPER_PIN_3, LOW);
//  digitalWrite(STEPPER_PIN_4, LOW);
//  break;
//  case 3:
//  digitalWrite(STEPPER_PIN_1, HIGH);
//  digitalWrite(STEPPER_PIN_2, LOW);
//  digitalWrite(STEPPER_PIN_3, LOW);
//  digitalWrite(STEPPER_PIN_4, LOW);
// 
//  
//} 
//  }
//step_number++;
//  if(step_number > 3){
//    step_number = 0;
//  }
//}
