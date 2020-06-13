## 0.개요
이 프로젝트는 라즈베리 파이의 **cpu온도**를 측정할 수 있는 다양한 방법들을 
소개해보고자합니다. 일반적으로 라즈베리파이가 데스크탑, 노트북에 비해 저전력을 사용하지만 보통의 컴퓨터와 마찬가지로 과다한 작업을 하게될 경우 발열이 발생합니다. 모든 전자기기가 그렇듯 발열이 과도하게 발생하면(평균 65~70'C) 성능저하 현상이 발생하며 더 나아가 프로세스가 멈출 수도 있습니다. 아래의 방법들을 통해 cpu 과다 발열을 효과적으로 예방할 수 있습니다. 

프로젝트 참조: https://projects.raspberrypi.org/en/projects/temperature-log

# 1. 간단한 라즈베리 파이 CPU 온도측정 방법

## - vcgencmd를 사용 (Video Core Generate Command )
터미널 창에서 **vcgencmd measure_temp**를 입력한다. 
- 사실 위 명령어는 라즈베리 파이의 GPU온도를 표시해주는 명령어지만 일반적으로 라즈베리 파이의 CPU와 GPU 온도는 약 1'C 정도밖에 차이가 안나기 때문에  GPU 온도로 CPU온도를 충분히 예측할 수 있다.

## - thermal node 읽기
**cat /sys/class/thermal/thermal_zone0/temp**을 입력한다. 
라즈베리 파이 커널의 thermal node에 자동적으로 CPU온도가 기록되는데 이 값을 불러와서 온도를 알 수 있다.

참조 [raspiTemp.sh](https://github.com/paul5404/finalProject/blob/master/raspiTemp.sh) 

# 2. 파이썬과 그래프를 이용한 cpu 온도 변화
matplotlib
- sudo apt-get install python3-matplotlib

## 프로그램 실행
- cpu_temp.csv파일을 생성하여 측정 온도값을 이 파일에 지속적으로 저장시킨다.

- 온도가 65도를 넘어가면 더 이상 저장하지 않고 종료시킨다.

## csv파일이란?
- comma separated version,즉 컴마(,)로 구분된 파일입니다. 
- 각 레코드 간에는 줄바꿈으로 구분됩니다. 참조 [cpu_temp.csv](https://github.com/paul5404/finalProject/blob/master/cpu_temp.csv)
- csv파일은 다른 파일들에 비해서 범용성이 뛰어나서 일반 text파일, excel파일등으로 쉽게 읽어올 수 있으며, php를 이용하여 웹에서의 출력도 가능하다. 

## 그래프
- 온도 변화를 그래프를 이용해서 시각적으로 보여준다. 참조 [graph.png](https://github.com/paul5404/finalProject/blob/master/graph.png)

- x축: 시간
- y축: CPU 온도

plt.pause(n)을 이용해서 그래프에 표현할 수 있는 주기를 설정할 수 있다.


# 3. Crontab
- crontab이란?
- 유닉스/리눅스 계열에서는 기본적으로 제공하는 툴로 사용자가 원하는 시간에 주기적으로 일을 시키기 위해 crontab(크론탭)을 사용합니다. 즉 cron(크론)이라는 원하는 시간에 명령을 내리는 데몬이 작동하도록 하는 실행 툴이라 할 수 있습니다. 

서버가 24시간 가동되고 있으므로 적절한 시간에 적절한 명령어를 주어서 자동으로 실행시킬 수 있는 툴이라고 할 수 있습니다.

예를 들어 새벽 4시에 데이타베이스를 백업 받아 줘라든지, 아침 7시에 서버의 사용량을 리포트하도록 한다든지 등등 아주 편리하게 활용할 수 있는 툴이라고 합니다.

## crontab 설정하기
- crontab -e: 크론탭을 실행한다.
- crontab -r: 등록된 크론탭을 삭제한다.
- crontab -l: 현재 등록된 크론탭 리스트가 무엇인지 터미널 상에서 출력한다.
  
- service cron status: 현재 사용중인 크론탭의 전반적인 스탯을 알려준다.
- service cron stop/start(restart) : 크론탭을 중지시키거나/시작(재시작)시켜준다.

## crontab 설정 규칙
ㅁ ㅁ ㅁ ㅁ ㅁ command~ (ㅁ = *)
- 첫번째 ㅁ: 분(0-59)
- 두번째 ㅁ: 시간(0-23)
- 세번째 ㅁ: 일(1-31)
- 네번째 ㅁ: 월(1-12)
* 다섯번째 ㅁ: 요일(0-6), 일요일 = 0

ex) ㅁ ㅁ ㅁ ㅁ ㅁ test.sh: 1분마다 실행,  ㅁ/10 ㅁ ㅁ ㅁ ㅁ test.sh: 10분마다 실행..

더 많은 자료: https://happist.com/553442, https://loveroid.tistory.com/57
                 
# 4. CSV파일을 웹으로 출력하기(php)



## 개선방향
- 현재 상황에서 cpu온도를 조절할 수 있는 장치가 방열판밖에 없었기 때문에 쿨링 팬과 같은 외부적인 부품들을 이용하여 실제로 cpu온도가 낮아지는 것을 구체적으로 관찰할 수도 있을 것이다.
