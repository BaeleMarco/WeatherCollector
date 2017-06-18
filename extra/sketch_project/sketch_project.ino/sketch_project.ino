/*Sensors*/
#include <SFE_BMP180.h>
  SFE_BMP180 pressure;
#include <Wire.h>
#include <MQ135.h>
  MQ135 mq135_sensor = MQ135(A3);
#include <DHT.h>
  DHT dht(2,11); //2 = pin, 11 = type sensor
  int rainAnalog = A2;
  int rainDigital = 3;

/*Send it*/
  #include <RCSwitch.h>
  RCSwitch mySwitch = RCSwitch();

/*Led*/
int LedR = 11;
int LedG = 9;
int LedB = 10;

void setup() {
  Serial.begin(9600);
  pinMode(LedR,OUTPUT);
  pinMode(LedG,OUTPUT);
  pinMode(LedB,OUTPUT);
  
//  dht.begin();
  if (pressure.begin()){
      Serial.println("BMP180 init success");    
  }else{
      digitalWrite(LedB, true);
      Serial.println("BMP180 init fail\n\n");
  }
  /*Send it*/
  mySwitch.enableTransmit(6); //Transmitter pin\
}

void loop(){
  mySwitch.send(("1" + String(returnTemperature()*100)).toInt(),24); // *100 so that 14.02 -> 1402
  mySwitch.send(216,24);
  mySwitch.send(("3" + String((returnPressure()*0.0295333727)*100)).toInt(),24); //*0.0295333727 to get Hg
  mySwitch.send(("4" + String(returnAirQuality())).toInt(),24);
  mySwitch.send(("5" + String(returnRain())).toInt(),24);
  /*WAIT TO SEND DATA*/
  delay(1000);
}

double returnTemperature(){
    char status;
    double T;
    status = pressure.startTemperature();
    if (status != 0)
    {
        delay(status);
        status = pressure.getTemperature(T);
        if(status != 0){
            return T;
        }
    }
    ledRed();
}

double returnHumidity(){
    float h = dht.readHumidity();
    if (isnan(h)) {
      ledRed();
      return 16.0;
    }
    return h;
}
double returnPressure()
{
    char status;
    double T,P;
  
    //Need temp to calculate pressure
    T = returnTemperature();
    status = pressure.startPressure(3);
    if (status != 0)
    {
        delay(status);
        status = pressure.getPressure(P, T);
        if (status != 0)
        {
            return P;
        }else{
            ledBlue();
        }
    }else{
        ledBlue();
    }
}

double returnRain(){
  if(!(digitalRead(rainDigital))){
    return (1023-analogRead(rainAnalog))/1023.0*100;
  }else{
    return 0.0;
  }
}

double returnAirQuality()
{
    float correctedPPM = mq135_sensor.getCorrectedPPM(returnTemperature(), 17);
    return 100.0-(correctedPPM / 10000);
    Serial.println(100.0-(correctedPPM / 10000));
}

void ledOut(){
     digitalWrite(LedR, false);
     digitalWrite(LedG, false);
     digitalWrite(LedB, false);
}

void ledWhite(){
     digitalWrite(LedR, true);
     digitalWrite(LedG, true);
     digitalWrite(LedB, true);
}

void ledRed(){
     digitalWrite(LedR, true);
     digitalWrite(LedG, false);
     digitalWrite(LedB, false);
}

void ledGreen(){
     digitalWrite(LedR, false);
     digitalWrite(LedG, true);
     digitalWrite(LedB, false);
}

void ledBlue(){
     digitalWrite(LedR, false);
     digitalWrite(LedG, false);
     digitalWrite(LedB, true);
}
