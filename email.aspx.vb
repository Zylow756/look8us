
Imports System.Net.Mail
Imports System.Data.Odbc.OdbcConnection
Imports System.Data

Partial Class email
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

    Private emailid As String


    Protected Sub Page_Load(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Load
        '============================================
        con = New Odbc.OdbcConnection(ConfigurationManager.ConnectionStrings("connection").ToString())

        If con.State = ConnectionState.Closed Then

            con.Open()

        End If


        ssql = "select * from member where mid=" & Request.QueryString("mid")

        dadd = New Odbc.OdbcDataAdapter(ssql, con)
        ds = New DataSet()
        dadd.Fill(ds, "member")
        dt = ds.Tables("member")

        'dt.Rows(0)("uname").ToString()
        emailid = dt.Rows(0)("email").ToString()

        '============================================





        Response.Write(Request.QueryString("us"))

        Dim mail As New MailMessage()
        Dim bd As String

        Dim ma = New MailAddress("support@look8us.com")
        mail.From = ma


        mail.To.Add(emailid)
        ' mail.CC.Add( "jyotishupay@gmail.com")

        mail.Bcc.Add("websoftkota@gmail.com")

        '  mail.Subject = "Ask Question from Visitor: Name "

        '  subj = "Ask Question from Visitor: Name -" + Request.QueryString("yname").ToString + "City -" + Request.QueryString("ycity").ToString

        mail.Subject = "Forget Password Request(Look8us.com): "

        mail.IsBodyHtml = True

        bd = "<b>Dear Member,  :</b><br>Please find Your login detail : <br><br><b>User/Mail ID : </b>" + emailid + " <br><b>Password : </b>" + Request.QueryString("pass").ToString

        ' bd = "<b>Ask question from visitor :</b>  Name : "

        mail.Body = bd


        mail.Headers.Add("Reply-To", "support@look8us.com")


        Try

            Dim smtpMailObj = New SmtpClient("69.175.7.170", 25)
            'eg:localhost, 192.168.0.x, replace with your server name

            ' smtpMailObj.Host = "jhalawar.net"

            smtpMailObj.DeliveryMethod = Net.Mail.SmtpDeliveryMethod.Network
            ' smtpMailObj.Credentials = New System.Net.NetworkCredential("info@jyotishupay.com", "*akc123")
            smtpMailObj.Credentials = New System.Net.NetworkCredential("enq@jyotishupay.com", "*Akc123")


            Response.Write(emailid)

            smtpMailObj.Send(mail)

            Response.Write("hi")

            Response.Redirect("user/forgetPassword.php?msg=1")
            '   Response.Write(subj)
            Response.Write(bd)

        Catch

            ' Response.Write("Message Delivery Fails")

        End Try


    End Sub
End Class
