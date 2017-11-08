#!groovy

pipeline {
    agent any

    environment {
        MY_ENV = 'true'
    }

    stages {
        stage('prepare') {
            steps {
                sh 'printenv'
                sh 'php --version'
                sh 'composer --version'
            }
        }
        stage('build') {
            steps {
                sh 'composer install'
            }
        }
        stage('grade') {
            steps {
                sh 'composer grade'
                sh 'putgrade'
            }
        }
    }

    post {
        always {
            sh 'rm -fr vendor'
        }
        success {
            echo 'SUCCESS'
        }
        failure {
            echo 'Failure'
            mail to: 'donstringham@weber.edu',
                subject: "Failed Pipeline: ${currentBuild.fullDisplayNamek}",
                body: "Something is wrong with ${env.BUILD_URL}"
        }
    }
}
