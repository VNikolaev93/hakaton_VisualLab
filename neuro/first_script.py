# -*- coding: utf-8 -*-

#from mtcnn.mtcnn import MTCNN
import cv2
import tensorflow as tf
from align import detect_face
#from align import detect_face
import facenet
import imutils
import numpy as np
#import argparse
#from face_detect_demo.py import getFace

minsize = 20
threshold = [0.6, 0.7, 0.7]
factor = 0.709
margin = 44
input_image_size = 160

sess = tf.Session()
pnet, rnet, onet = detect_face.create_mtcnn(sess, 'align')
facenet.load_model("20170512-110547/20170512-110547.pb")
images_placeholder = tf.get_default_graph().get_tensor_by_name("input:0")
embeddings = tf.get_default_graph().get_tensor_by_name("embeddings:0")
phase_train_placeholder = tf.get_default_graph().get_tensor_by_name("phase_train:0")
embedding_size = embeddings.get_shape()[1]

def getFace(img):
    faces = []
    img_size = np.asarray(img.shape)[0:2]
    bounding_boxes, _ = detect_face.detect_face(img, minsize, pnet, rnet, onet, threshold, factor)
    if not len(bounding_boxes) == 0:
        for face in bounding_boxes:
            if face[4] > 0.50:
                det = np.squeeze(face[0:4])
                bb = np.zeros(4, dtype=np.int32)
                bb[0] = np.maximum(det[0] - margin / 2, 0)
                bb[1] = np.maximum(det[1] - margin / 2, 0)
                bb[2] = np.minimum(det[2] + margin / 2, img_size[1])
                bb[3] = np.minimum(det[3] + margin / 2, img_size[0])
                cropped = img[bb[1]:bb[3], bb[0]:bb[2], :]
                resized = cv2.resize(cropped, (input_image_size,input_image_size),interpolation=cv2.INTER_AREA)
                faces.append({'face':resized,'rect':[bb[0],bb[1],bb[2],bb[3]]})
    return faces

def compare2face(img1,img2):
    face1 = getFace(img1)
    face2 = getFace(img2)
    if face1 and face2:
        # calculate Euclidean distance
        dist = np.sqrt(np.sum(np.square(np.subtract(face1[0]['embedding'], face2[0]['embedding']))))
        return dist
    return -1

def same_person(pers1, pers2):
    res = 0;
    for i in range(len(pers1)):
        res += (pers1[i] - pers2[i]) ** 2;
    res **= 1/2;
    if (res <= 1.1):
        return (True);
    else:
        return (False);

#detector = MTCNN()
#img = cv2.imread("/home/ilya/Рабочий стол/1.jpg")
#print(detector.detect_faces(img))
distance = 0
img1 = cv2.imread("/home/ilya/Рабочий стол/HACKATHON?images/3.jpg")
img2 = cv2.imread("/home/ilya/Рабочий стол/HACKATHON?images/4.jpg")
#img1 = imutils.resize(img1,width=1000)
#img2 = imutils.resize(img2,width=1000)
#faces1 = getFace(img1)
#faces2 = getFace(img2)
distance = compare2face(img1, img2)
print("distance = "+str(distance))
print("Result = " + ("same person" if distance <= threshold else "not same person"))
#for x in range(len(faces1)):
#    for y in range(len(faces2)):
#        if same_person(faces1[x], faces2[y]):
#            print("Yes")
#            exit()
#print("no")
