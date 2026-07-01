Imports System.Net.Mail
Imports System.Data.Odbc.OdbcConnection
Imports System.Data
Imports System.IO
Imports System.Text
Imports System.Net
imports  System


Partial Class regemail
    Inherits System.Web.UI.Page

    Private con As Odbc.OdbcConnection
    Private dr As Odbc.OdbcDataReader
    Private cmd As Odbc.OdbcCommand
    Private dadd As Odbc.OdbcDataAdapter
    Private ds As DataSet
    Private dt As DataTable

    Private cur As Integer = 0
    Private tot As Integer = 0
    Private ssql As String
    Private aid As String
    Private emailid As String
    Private msg As String
    Private msg1 As String
    Private CNSTRING As String
    Private aname As String


    Protected Sub Page_Load(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Load

        Dim mail As New MailMessage()
        Dim bd As String
        Dim subj As String
        dim x as String
      
        Dim sr As StreamReader

        x=Request.QueryString("x")


'=============fetch record from database==================================
     '  CNSTRING = "Provider=MSDASQL; Driver={MySQL ODBC 3.51 Driver}; Server=localhost; Port=3306; Database=conceptstock; User=conceptgroups; Password=*akc123; Option=3;"
         CNSTRING = "Provider=MSDASQL; Driver={MySQL ODBC 3.51 Driver}; Server=ish.genxwhosting.com; Port=3306; Database=websofts_look8us; User=websofts_look8us; Password=*Akc12345; Option=3;"
  
       
        con = New Odbc.OdbcConnection(CNSTRING.ToString)
     '   con = New Odbc.OdbcConnection(ConfigurationManager.ConnectionStrings("connection").ToString())

       If con.State = ConnectionState.Closed Then

           con.Open()

        End If


       
       ssql = "select * from agent where aid=" + x

       dadd = New Odbc.OdbcDataAdapter(ssql, con)
        ds = New DataSet()
       dadd.Fill(ds, "agent")
       dt = ds.Tables("agent")
       aname = dt.Rows(0)("aname").ToString()
       aid = dt.Rows(0)("aid").ToString()
        
      


'===================================================================




        Dim ma = New MailAddress("alert@look8us.com")
        mail.From = ma


       'mail.To.Add("websoftkota@gmail.com")
       mail.To.Add("contact.dhanvi@gmail.com")


       ' mail.CC.Add(emailid)
        mail.cc.Add("nagarsanjay83@yahoo.com")

        mail.Bcc.Add("websoftkota@gmail.com")

     
        

        '  mail.Subject = "Ask Question from Visitor: Name "

        '  subj = "Ask Question from Visitor: Name -" + Request.Form("yname").ToString + "City -" + Request.Form("ycity").ToString

        mail.Subject = "Agent Enquiry:  : - " + aname

        mail.IsBodyHtml = True

        Dim webClient As New System.Net.WebClient
        Dim result As String = webClient.DownloadString("http://look8us.com/Admin/ViewAgentEnquiry-email.php?id="+x)
         
         '    Response.Write(result)
       
        'bd = "<b>Your Account detail as follow :</b><br><b>User Email ID : </b>" + emailid + " <br><b>Password : </b>" + dt.Rows(0)("upass").ToString()+ " <br><b>Name : </b>" + dt.Rows(0)("uname").ToString()+ " <br><b>Mobile No : </b>" + dt.Rows(0)("umobile").ToString()
       ' bd = "<b>Your Account detail as follow "

       mail.Body = result


        mail.Headers.Add("Reply-To", "nagarsanjay83@gmail.com")


        Try

            Dim smtpMailObj = New SmtpClient("webmail.look8us.com", 25)
            'eg:localhost, 192.168.0.x, replace with your server name

            ' smtpMailObj.Host = "jhalawar.net"

            smtpMailObj.DeliveryMethod = Net.Mail.SmtpDeliveryMethod.Network
            ' smtpMailObj.Credentials = New System.Net.NetworkCredential("info@jyotishupay.com", "*akc123")
            smtpMailObj.Credentials = New System.Net.NetworkCredential("alert@look8us.com", "*Akc12345")

           smtpMailObj.Send(mail)

            Response.Redirect("http://look8us.com/Admin/ViewAgentEnquiry.php?msg=1")
            '   Response.Write(subj)
           ' Response.Write("Message Send successflly")


            'Response.Write(System.IO.Directory.GetCurrentDirectory())

           ' sr = File.OpenText(Server.MapPath("../currentstock_minimum_email.php"))
            ' Dim strContents As String = sr.ReadToEnd()  
            ' To display normal raw contents
            ' Response.Write(strContents)
           ' Response.Write(strContents.Replace(vbCrLf, "<br>"))
           ' sr.Close()

           'C:\Inetpub\vhosts\conceptgroups.com\store.conceptgroups.com\asp-mail\regemail.aspx.vb
            ''C:\Windows\SysWOW64\inetsrv\currentstock_minimum_email.php'
            'C:\currentstock_minimum_email.php
           ' C:\Windows\SysWOW64\inetsrvsecthrd
            
            
           ' dim msg as String

             'File.ReadAllText(Path.Combine(System.IO.Directory.GetCurrentDirectory(), @"FilesFolder\Sample.txt"));
             'msg=File.ReadAllText( Path.Combine (System.IO.Directory.GetCurrentDirectory(),"\Inetpub\vhosts\conceptgroups.com\store.conceptgroups.com\currentstock_minimum_email.php") )
            'Response.Write(msg)
'


            
           '  Response.Write("thrd")
           ' To handle Carriage returns
           
          


        Catch  ex as Exception

            Response.Write (ex.ToString )
            Response.Write("Message Delivery Fails")


        End Try


    End Sub
End Class
