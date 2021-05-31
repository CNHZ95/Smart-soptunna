#include <SoftwareSerial.h>
#include <LiquidCrystal.h> // Load Liquid Crystal Library
LiquidCrystal LCD(11,10,9,2,3,4,5); // Create Liquid Crystal Object called LCD

// WiFi module
#define RX 7
#define TX 6
SoftwareSerial esp8266(RX,TX); 

// Sensor
#define trigPin 13 // Sensor Echo pin connected to Arduino pin 13
#define echoPin 12 // Sensor Trip pin connected to Arduino pin 12

long percentage;
long initial = 30; // Height
int countTrueCommand;
int countTimeCommand;

String AP = ""; // AP name
String PASS = ""; // AP password
String HOST = ""; // IP-address
String PORT = "80";
  
void setup() {
  // WiFi module
  Serial.begin(9600);
  esp8266.begin(115200);
  sendCommand("AT", 5, "OK");
  sendCommand("AT+CWMODE=1", 5, "OK");
  sendCommand("AT+CWJAP=\"" + AP + "\",\"" + PASS + "\"", 20, "OK");
  
  // Sensor
  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);

  // LCD
  LCD.begin(16, 2); // Tell Arduino to start your 16 column 2 row LCD
  LCD.setCursor(0, 0);  // Set LCD cursor to upper left corner, column 0, row 0
  LCD.print("Soptunna niva:");  // Print Message on First Row
}

void loop() {
  long duration, distance;
  
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  duration = pulseIn(echoPin, HIGH);
  distance = (duration / 2) / 29.1;
  percentage = 100 - distance * 100 / initial;
 
  LCD.setCursor(0, 1);  // Set cursor to first column of second row
  LCD.print("                "); // Print blanks to clear the row
  LCD.setCursor(0, 1);   // Set Cursor again to first column of second row
  LCD.print(percentage); // Print measured distance
  LCD.print(" %");  // Print your units
  delay(1000); // Pause to let things settle
  
  String getData = "GET /container/post_data.php?distance=" + String(percentage);
  sendCommand("AT+CIPMUX=1", 5, "OK");
  sendCommand("AT+CIPSTART=0,\"TCP\",\"" + HOST + "\"," + PORT, 15, "OK");
  sendCommand("AT+CIPSEND=0," + String(getData.length() + 4), 4, ">");

  if (percentage >= 0 && percentage <= 100) {  
    esp8266.println(getData);
    delay(1000); // ms
  }
  
  countTrueCommand++;
  sendCommand("AT+CIPCLOSE=0", 5, "OK");
}

void sendCommand(String command, int maxTime, char readReplay[]) {
  boolean found = false; 
  
  Serial.print(countTrueCommand);
  Serial.print(". at command => ");
  Serial.print(command);
  Serial.print(" ");
  while(countTimeCommand < (maxTime)) {
    esp8266.println(command); // at+cipsend
    if(esp8266.find(readReplay)) { // ok
      found = true;
      break; 
    }
  
    countTimeCommand++<
  }
  
  if(found == true) {
    Serial.println("OK");
    countTrueCommand++;
    countTimeCommand = 0;
  }
  
  if(found == false) {
    Serial.println("Fail");
    countTrueCommand = 0;
    countTimeCommand = 0;
  }
  
  found = false;
 }